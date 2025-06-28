<?php

namespace App\Models;

use CodeIgniter\Model;

class KuesionerAnswerModel extends Model
{
    protected $table = 'kuesioner_answer';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kuesioner_id', 'user_id', 'answers', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function saveAnswers($kuesionerId, $userId, $answers, $status = 'draft')
    {
        $data = [
            'kuesioner_id' => $kuesionerId,
            'user_id' => $userId,
            'answers' => json_encode($answers, JSON_UNESCAPED_UNICODE),
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $existing = $this->where('kuesioner_id', $kuesionerId)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            return $this->update($existing['id'], $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->insert($data);
        }
    }

    public function getAnswerStatus($kuesionerId, $userId)
    {
        $answer = $this->where('kuesioner_id', $kuesionerId)
            ->where('user_id', $userId)
            ->first();

        return $answer ? $answer['status'] : null;
    }

    public function getAnswerByUser($kuesionerId, $userId)
    {
        $answer = $this->where('kuesioner_id', $kuesionerId)
            ->where('user_id', $userId)
            ->first();

        if ($answer && !empty($answer['answers'])) {
            $answer['answers'] = json_decode($answer['answers'], true);
        }

        return $answer;
    }

    public function getLastAnsweredPage($kuesionerId, $userId)
    {
        $answer = $this->getAnswerByUser($kuesionerId, $userId);
        
        if (!$answer || empty($answer['answers'])) {
            return 1;
        }

        $lastPage = 1;
        foreach ($answer['answers'] as $pageKey => $page) {
            if (strpos($pageKey, 'p_') === 0) {
                $pageId = (int) str_replace('p_', '', $pageKey);
                if ($pageId > $lastPage) {
                    $lastPage = $pageId;
                }
            }
        }

        return $lastPage;
    }

    public function submitAnswers($kuesionerId, $userId)
    {
        $answer = $this->where('kuesioner_id', $kuesionerId)
            ->where('user_id', $userId)
            ->first();

        if ($answer) {
            return $this->update($answer['id'], ['status' => 'submitted', 'updated_at' => date('Y-m-d H:i:s')]);
        }

        return false;
    }
}