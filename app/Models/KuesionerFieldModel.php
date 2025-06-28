<?php

namespace App\Models;

use CodeIgniter\Model;

class KuesionerFieldModel extends Model
{
    protected $table = 'kuesioner_fields';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_html',
        'kuesioner_id',
        'page_id',
        'section_id',
        'type',
        'label',
        'options',
        'note',
        'required',
        'conditional_logic',
        'created_on',
        'created_by',
        'updated_on',
        'updated_by',
        'ordering_count',
        'scale_min',
        'scale_max',
        'point_labels'
    ];

    protected $useTimestamps = false;
    protected $beforeInsert = ['handleJsonFields', 'setOrderingCount'];
    protected $beforeUpdate = ['handleJsonFields'];

    protected function setOrderingCount(array $data)
    {
        if (isset($data['data']['section_id'])) {
            $data['data']['ordering_count'] = $this->getNextOrdering($data['data']['section_id']);
        }
        return $data;
    }

    public function getNextOrdering($sectionId)
    {
        $builder = $this->where('section_id', $sectionId);
        $maxOrder = $builder->selectMax('ordering_count')->get()->getRowArray();
        return ($maxOrder['ordering_count'] ?? 0) + 1;
    }

    protected function handleJsonFields(array $data)
{
    if (isset($data['data'])) {
        if (isset($data['data']['options']) && is_array($data['data']['options'])) {
            // Perbaikan: Untuk user_field, pastikan disimpan sebagai array sederhana
            if (isset($data['data']['type']) && $data['data']['type'] === 'user_field') {
                // Jika sudah berupa array sederhana, langsung encode
                if (count($data['data']['options']) === 1 && is_string($data['data']['options'][0])) {
                    $data['data']['options'] = json_encode($data['data']['options'], JSON_UNESCAPED_UNICODE);
                } 
                // Jika berupa string, ubah ke array dulu
                elseif (is_string($data['data']['options'])) {
                    $data['data']['options'] = json_encode([$data['data']['options']], JSON_UNESCAPED_UNICODE);
                }
            } else {
                $data['data']['options'] = json_encode($data['data']['options'], JSON_UNESCAPED_UNICODE);
            }
        }

        if (isset($data['data']['conditional_logic'])) {
            $data['data']['conditional_logic'] = $this->processJsonField($data['data']['conditional_logic']);
        }

        if (isset($data['data']['type']) && $data['data']['type'] === 'scale' && isset($data['data']['point_labels'])) {
            if (is_array($data['data']['point_labels'])) {
                $data['data']['point_labels'] = implode(',', $data['data']['point_labels']);
            } elseif (is_string($data['data']['point_labels'])) {
                $labels = explode(',', $data['data']['point_labels']);
                $data['data']['point_labels'] = implode(',', array_map('trim', $labels));
            }
        }
    }

    return $data;
}

    protected function processJsonField($data)
    {
        if (is_array($data)) {
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if (is_string($data) && json_decode($data) !== null) {
            return $data;
        }
        return json_encode([], JSON_UNESCAPED_UNICODE);
    }

    public function getFieldsBySection($sectionId)
    {
        try {
            $fields = $this->where('section_id', $sectionId)
                ->orderBy('ordering_count', 'ASC')
                ->findAll();

            if (empty($fields)) {
                return [];
            }

            return array_map(function ($field) {
                $field['options'] = json_decode($field['options'] ?? '[]', true);

                // scale
                if ($field['type'] === 'scale') {
                    $options = $field['options'] ?? [];
                    $field['scale_min'] = $options['min'] ?? 1;
                    $field['scale_max'] = $options['max'] ?? 5;

                    if (!empty($field['point_labels'])) {
                        $field['point_labels'] = $field['point_labels'];
                    } elseif (!empty($options['labels'])) {
                        $field['point_labels'] = implode(',', $options['labels']);
                    } else {
                        $field['point_labels'] = implode(',', range(
                            $field['scale_min'],
                            $field['scale_max']
                        ));
                    }
                }

                // grid
                if ($field['type'] === 'grid') {
                    $field['grid_rows'] = $field['options']['rows'] ?? [];
                    $field['grid_columns'] = $field['options']['columns'] ?? [];
                }

                return $field;
            }, $fields);
        } catch (\Exception $e) {
            log_message('error', 'Error in getFieldsBySection: ' . $e->getMessage());
            return [];
        }
    }

    protected function formatField($field)
    {
        $field['options'] = json_decode($field['options'] ?? '[]', true);
        $field['conditional_logic'] = json_decode($field['conditional_logic'] ?? '[]', true);

        if ($field['type'] === 'scale') {
            $field['min_scale'] = $field['options']['min'] ?? 1;
            $field['max_scale'] = $field['options']['max'] ?? 5;
            $field['point_labels'] = $field['options']['labels'] ?? [];
        }

        if ($field['type'] === 'grid') {
            $field['grid_rows'] = $field['options']['rows'] ?? [];
            $field['grid_columns'] = $field['options']['columns'] ?? [];
        }

        return $field;
    }
}
