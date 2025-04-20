<?php
declare(strict_types=1);

namespace App\Task\Validator;

use App\Task\DTO\TaskRequestDTO;

class TaskRequestValidator
{
    const string ERROR_REQUIRED_TITLE = 'Title is required.';
    const string ERROR_REQUIRED_DESCRIPTION = 'Description is required.';

    public static function validate(TaskRequestDTO $dto): array
    {
        $errors = [];

        if (empty($dto->title)) {
            $errors[] = self::ERROR_REQUIRED_TITLE;
        }

        if (empty($dto->description)) {
            $errors[] = self::ERROR_REQUIRED_DESCRIPTION;
        }

        return $errors;
    }
}
