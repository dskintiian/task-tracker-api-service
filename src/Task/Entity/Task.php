<?php
declare(strict_types=1);

namespace App\Task\Entity;

use App\Task\Enum\TaskStatusEnum;
use DateTimeInterface;

class Task
{
    public function __construct(
        private readonly string $id,
        private string $title,
        private string $description,
        private TaskStatusEnum $status = TaskStatusEnum::NEW,
        private string|null $assigneeId = null,
        private readonly DateTimeInterface $createdAt,
        private DateTimeInterface|null $updatedAt = null
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): TaskStatusEnum
    {
        return $this->status;
    }

    public function setStatus(TaskStatusEnum $status): void
    {
        $this->status = $status;
    }

    public function getAssigneeId(): string|null
    {
        return $this->assigneeId;
    }

    public function setAssigneeId(string $id): void
    {
        $this->assigneeId = $id;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt(): DateTimeInterface|null
    {
        return $this->updatedAt;
    }
}