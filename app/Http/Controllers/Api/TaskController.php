<?php

namespace App\Http\Controllers\Api;

use App\Services\TaskService;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{
    public function __construct(private TaskService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(
            $this->service->index(),
            Response::HTTP_OK
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->service->show($id),
            Response::HTTP_OK
        );
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->store($request->validated()),
            Response::HTTP_CREATED
        );
    }

    public function update(int $id, UpdateRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->update($id, $request->validated()),
            Response::HTTP_OK
        );
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json(
            $this->service->destroy($id),
            Response::HTTP_OK
        );
    }
}
