<?php
declare(strict_types=1);

namespace App\Task\Mapper;

use App\Task\DTO\TaskResponseDTO;
use App\Task\Entity\Task;

class TaskResponseMapper
{
    public static function fromEntity(Task $task): TaskResponseDTO
    {
        return new TaskResponseDTO(
            $task->getId(),
            $task->getTitle(),
            $task->getDescription(),
            $task->getStatus()->value,
            $task->getAssigneeId(),
            $task->getCreatedAt()->format(DATE_ATOM),
            $task->getUpdatedAt()?->format(DATE_ATOM)
        );
    }
}
