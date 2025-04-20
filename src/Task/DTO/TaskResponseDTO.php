<?php
declare(strict_types=1);

namespace App\Task\DTO;

class TaskResponseDTO
{
    public function __construct(
        public string $id,
        public string $title,
        public string $description,
        public string $status,
        public string|null $assigneeId,
        public string $createdAt,
        public string|null $updatedAt,
    ) {}
}
