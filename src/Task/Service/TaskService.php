<?php
declare(strict_types=1);

namespace App\Task\Service;

use App\Task\DTO\TaskRequestDTO;
use App\Task\Entity\Task;
use App\Task\Enum\TaskStatusEnum;
use App\Task\Exception\TaskNotFoundException;
use App\Task\Repository\TaskRepository;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class TaskService
{
    public function __construct(private readonly TaskRepository $repository)
    {
    }

    public function createTask(TaskRequestDTO $dto): Task
    {
        $task = new Task(
            id: Uuid::uuid7()->toString(),
            title: $dto->title,
            description: $dto->description,
            status: TaskStatusEnum::NEW,
            assigneeId: $dto->assigneeId,
            createdAt: new DateTimeImmutable()
        );

        $this->repository->save($task);

        return $task;
    }

    public function listTasks(string|null $status = null, string|null $assigneeId = null): array
    {
        return $this->repository->findAll(
            array_filter(['status' => $status, 'assigneeId' => $assigneeId])
        );
    }

    public function updateStatus(string $taskId, TaskStatusEnum $status): Task
    {
        $task = $this->repository->find($taskId);
        if (!$task) {
            throw new TaskNotFoundException();
        }

        /** @var Task $task */
        $task->setStatus($status);
        $task->setUpdatedAt(new DateTimeImmutable());
        $this->repository->save($task);

        return $task;
    }

    public function assignTask(string $taskId, string $userId): Task
    {
        /** @var Task $task */
        $task = $this->repository->find($taskId);
        if (!$task) {
            throw new TaskNotFoundException();
        }

        $task->setAssigneeId($userId);
        $task->setUpdatedAt(new DateTimeImmutable());
        $this->repository->save($task);

        return $task;
    }
}
