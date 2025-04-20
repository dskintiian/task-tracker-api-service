<?php
declare(strict_types=1);

namespace App\Task\Controller;

use App\Core\Controller\AbstractController;
use App\Task\Enum\TaskStatusEnum;
use App\Task\Exception\TaskNotFoundException;
use App\Task\Mapper\TaskRequestMapper;
use App\Task\Mapper\TaskResponseMapper;
use App\Task\Service\TaskService;
use App\Task\Validator\TaskRequestValidator;
use Throwable;

class TaskController extends AbstractController
{
    public function __construct(private readonly TaskService $taskService)
    {
    }

    public function create(array $request): array
    {
        $dto = TaskRequestMapper::fromArray($request);
        $errors = TaskRequestValidator::validate($dto);

        if (!empty($errors)) {
            return $this->validationError($errors);
        }

        try {
            $task = $this->taskService->createTask($dto);
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }

        return $this->created(TaskResponseMapper::fromEntity($task));
    }

    public function list(array $query): array
    {
        $tasks = $this->taskService->listTasks(
            $query['status'] ?? null,
            $query['assigneeId'] ?? null
        );

        return $this->ok(array_map([TaskResponseMapper::class, 'fromEntity'], $tasks));
    }

    public function updateStatus(string $id, array $data): array
    {
        if (empty($data['status']) || !TaskStatusEnum::tryFrom($data['status'])) {
            return $this->validationError(['Invalid or empty status']);
        }

        try {
            $task = $this->taskService->updateStatus($id, TaskStatusEnum::from($data['status']));
        } catch (TaskNotFoundException $e) {
            return $this->notFound('Task not found');
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }

        return $this->ok(TaskResponseMapper::fromEntity($task));
    }

    public function assign(string $id, array $data): array
    {
        if (empty($data['assigneeId'])) {
            return $this->validationError(['Empty assignee ID']);
        }

        try {
            $task = $this->taskService->assignTask($id, $data['assigneeId']);
        } catch (TaskNotFoundException $e) {
            return $this->notFound('Task not found');
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }

        return $this->ok(TaskResponseMapper::fromEntity($task));
    }
}
