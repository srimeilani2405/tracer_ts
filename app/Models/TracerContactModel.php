<?php

namespace App\Models;

use CodeIgniter\Model;

class TracerContactModel extends Model
{
    protected $table = 'tracer_study_contacts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 
        'email', 
        'phone', 
        'position', 
        'qualification', 
        'contact_type', 
        'sort_order', 
        'program_studi', 
        'jurusan', 
        'tahun', 
        'show_email', 
        'show_phone'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = true;

    protected $contactTypes = [
        'directorate' => 'Wakil Direktur Bidang Kemahasiswaan',
        'team'        => 'Team Tracer Study POLBAN',
        'address'     => 'Alamat',
        'surveyor'    => 'Surveyor',
        'coordinator' => 'Koordinator Surveyor'
    ];

    public function getContactTypes(): array
    {
        return $this->contactTypes;
    }

    public function getContactsByType(string $type): array
    {
        if (!array_key_exists($type, $this->contactTypes)) {
            return [];
        }

        return $this->where('contact_type', $type)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    public function getDirectorContact(): ?array
    {
        return $this->where('contact_type', 'directorate')
            ->first();
    }

    public function getAddressInfo(): array
    {
        return $this->where('contact_type', 'address')
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    public function getSurveyorContacts($tahun = null): array
    {
        $builder = $this->where('contact_type', 'surveyor');

        if ($tahun) {
            $builder->where('tahun', $tahun);
        }

        $contacts = $builder->orderBy('program_studi, name')
            ->findAll();

        $filteredContacts = [];
        foreach ($contacts as $contact) {
            $displayData = [
                'id' => $contact['id'],
                'name' => $contact['name'],
                'program_studi' => $contact['program_studi'],
                'contact_type' => $contact['contact_type']
            ];

            if ($contact['show_email'] == 1 && !empty($contact['email'])) {
                $displayData['email'] = $contact['email'];
            }

            if ($contact['show_phone'] == 1) {
                if (!empty($contact['phone'])) {
                    $displayData['phone'] = $contact['phone'];
                }
                if (!empty($contact['no_telepon'])) {
                    $displayData['no_telepon'] = $contact['no_telepon'];
                }
                if (!empty($contact['no_hp'])) {
                    $displayData['no_hp'] = $contact['no_hp'];
                }
            }

            $filteredContacts[] = $displayData;
        }

        return $filteredContacts;
    }

    public function getCoordinatorContacts($tahun = null): array
    {
        $builder = $this->where('contact_type', 'coordinator');

        if ($tahun) {
            $builder->where('tahun', $tahun);
        }

        $contacts = $builder->orderBy('jurusan, name')
            ->findAll();

        $filteredContacts = [];
        foreach ($contacts as $contact) {
            $displayData = [
                'id' => $contact['id'],
                'name' => $contact['name'],
                'jurusan' => $contact['jurusan'],
                'contact_type' => $contact['contact_type']
            ];

            if ($contact['show_email'] == 1 && !empty($contact['email'])) {
                $displayData['email'] = $contact['email'];
            }

            if ($contact['show_phone'] == 1) {
                if (!empty($contact['phone'])) {
                    $displayData['phone'] = $contact['phone'];
                }
                if (!empty($contact['no_telepon'])) {
                    $displayData['no_telepon'] = $contact['no_telepon'];
                }
                if (!empty($contact['no_hp'])) {
                    $displayData['no_hp'] = $contact['no_hp'];
                }
            }

            $filteredContacts[] = $displayData;
        }

        return $filteredContacts;
    }

    public function getJurusanOptions(): array
    {
        return $this->db->table('organizations')
            ->select('name') 
            ->where('tipe', 'jurusan')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();
    }
}