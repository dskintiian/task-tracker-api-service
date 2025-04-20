<?php
declare(strict_types=1);

namespace App\Task\DTO;

readonly class TaskRequestDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string|null $assigneeId = null
    ) {
    }
}
