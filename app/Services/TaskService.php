<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Models\Task;

class TaskService
{
    protected $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTasks()
    {
        return $this->repository->all();
    }

    public function getTaskById($id)
    {
        return $this->repository->find($id);
    }

    public function createTask(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateTask(Task $task, array $data)
    {
        return $this->repository->update($task, $data);
    }

    public function deleteTask(Task $task)
    {
        return $this->repository->delete($task);
    }
}
