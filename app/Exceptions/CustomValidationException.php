<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CustomValidationException extends ValidationException
{
    public function render($request): JsonResponse
    {
        $errors = [];

        foreach ($this->validator->errors()->getMessages() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message
                ];
            }
        }

        return new JsonResponse([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'Validation failed',
            'errors' => $errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
