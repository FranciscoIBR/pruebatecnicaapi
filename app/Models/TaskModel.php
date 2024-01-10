<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'task';
    protected $allowedFields = [
        'titulo', 'descripcion', 'estado'
    ];

    protected $useTimestamps = true;
    protected $updatedField = 'updated_at';

    public function findTaskById($id)
    {
        $task = $this->asArray()->where(['id' => $id])->first();

        if (!$task) {
            throw new \Exception('Could not find task for specified ID');
        }

        return $task;
    }
}