<?php

namespace App\Controllers;

use Exception;
use App\Models\TaskModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Task extends BaseController
{
    public function index()
    {
        $model = new TaskModel();
        return $this->getResponse([
            'message' => 'Tasks retrieved successfully',
            'tasks' => $model->findAll()
        ]);
    }

    public function store()
    {
        $rules = [
            'titulo' => 'required',
            'descripcion' => 'required|min_length[6]|max_length[100]',
            'estado' => 'required|max_length[50]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        

        $model = new TaskModel();
        $model->save($input);

        $id = $model->getInsertID(); 


        $task = $model->where('id', $id)->first();

        return $this->getResponse([
            'message' => 'Task added successfully',
            'task' => $task
        ]);
    }

    public function show($id)
    {
        try {

            $model = new TaskModel();
            $task = $model->findTaskById($id);

            return $this->getResponse([
                'message' => 'Task retrieved successfully',
                'client' => $task
            ]);

        } catch (Exception $e) {
            return $this->getResponse([
                'message' => 'Could not find task for specified ID'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function update($id)
    {
        try {

            $model = new TaskModel();
            $model->findTaskById($id);

            $input = $this->getRequestInput($this->request);


            $model->update($id, $input);
            $task = $model->findTaskById($id);

            return $this->getResponse([
                'message' => 'Task updated successfully',
                'client' => $task
            ]);

        } catch (Exception $exception) {

            return $this->getResponse([
                'message' => $exception->getMessage()
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        try {

            $model = new TaskModel();
            $task = $model->findTaskById($id);
            $model->delete($task);

            return $this->getResponse([
                'message' => 'Task deleted successfully',
            ]);

        } catch (Exception $exception) {
            return $this->getResponse([
                'message' => $exception->getMessage()
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }
}