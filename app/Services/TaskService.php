<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    public function index(): LengthAwarePaginator
    {
        $tasks = Task::paginate(10);

        return $tasks;
    }

    public function show(int $id): Task
    {
        $task = Task::findOrFail($id);

        return $task;
    }

    public function store(array $data): Task
    {
        $task = Task::create($data);

        return $task->fresh();
    }

    public function update(int $id, array $data): Task
    {
        $task = Task::findOrFail($id);

        $task->update($data);

        return $task->fresh();
    }

    public function destroy(int $id): bool
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return true;
    }
}
