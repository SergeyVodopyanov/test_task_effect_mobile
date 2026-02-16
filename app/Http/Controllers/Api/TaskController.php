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
        $collection = $this->service->index();

        if ($collection->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json(
            $collection,
            Response::HTTP_OK
        );
    }

    public function show(int $id)
    {
        $result  = $this->service->show($id);

        if ($result) {
            return response()->json($result, Response::HTTP_OK);
        }

        return response()->json([], Response::HTTP_NOT_FOUND);
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
        $result  = $this->service->update($id, $request->validated());

        if ($result) {
            return response()->json($result, Response::HTTP_OK);
        }

        return response()->json(false, Response::HTTP_NOT_FOUND);
    }

    public function destroy(int $id): JsonResponse
    {
        $result  = $this->service->destroy($id);

        if ($result) {
            return response()->json(true, Response::HTTP_OK);
        }

        return response()->json(false, Response::HTTP_NOT_FOUND);
    }
}
