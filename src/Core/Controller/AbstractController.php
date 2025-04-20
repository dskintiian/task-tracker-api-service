<?php
declare(strict_types=1);

namespace App\Core\Controller;


abstract class AbstractController
{
    protected function ok(array|object $data): array
    {
        return [
            'statusCode' => 200,
            'body' => $data,
        ];
    }

    protected function error(string $message): array
    {
        return [
            'statusCode' => 400,
            'body' => [$message],
        ];
    }

    protected function validationError(array $errors): array
    {
        return [
            'statusCode' => 422,
            'body' => $errors,
        ];
    }

    protected function created(array|object $data): array
    {
        return [
            'statusCode' => 201,
            'body' => $data,
        ];
    }

    protected function notFound(string|null $error = null): array
    {
        return [
            'statusCode' => 404,
            'body' => [$error ?? 'Not found'],
        ];
    }
}
