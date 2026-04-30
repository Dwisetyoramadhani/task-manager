<?php

namespace App\Services;

use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskService
{

    protected $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function getAll()
    {
        return $this->taskRepo->getAll();

    }

    public function create(array $data)
    {
        return $this->taskRepo->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->taskRepo->update($id, $data);
    }

    public function delete($id)
    {
        $this->taskRepo->delete($id);

        return [
            'message' => 'Task deleted'
        ];
    }

    public function find($id)
    {
        $task = $this->taskRepo->find($id);

        return [
            'task' => $task
        ];
    }
}
