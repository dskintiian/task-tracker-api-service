<?php
declare(strict_types=1);

namespace App\Task\Mapper;

use App\Task\DTO\TaskRequestDTO;

class TaskRequestMapper
{
    public static function fromArray(array $data): TaskRequestDTO
    {
        return new TaskRequestDTO(
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['assigneeId'] ?? null
        );
    }
}
