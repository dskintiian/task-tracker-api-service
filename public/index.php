<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Storage\Driver\InMemoryDriver;
use App\Task\Controller\TaskController;
use App\Task\Repository\TaskRepository;
use App\Task\Service\TaskService;

// Create services manually (no DI container)
$inMemoryDriver = new InMemoryDriver();
$taskRepository = new TaskRepository($inMemoryDriver);
$taskService = new TaskService($taskRepository);
$taskController = new TaskController($taskService);

// Simple router
$method = $_SERVER['REQUEST_METHOD'];
$path = strtok($_SERVER['REQUEST_URI'], '?');
$input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR) ?? [];

$query = $_GET;

// Routing
$response = match (true) {
    $method === 'POST' && $path === '/tasks' =>
    $taskController->create($input),

    $method === 'GET' && $path === '/tasks' =>
    $taskController->list($query),

    $method === 'PATCH' && preg_match('#^/tasks/([^/]+)/status$#', $path, $matches) =>
    $taskController->updateStatus($matches[1], $input),

    $method === 'PATCH' && preg_match('#^/tasks/([^/]+)/assign$#', $path, $matches) =>
    $taskController->assign($matches[1], $input),

    default => ['statusCode' => 404, 'body' => ['error' => 'Not Found']],
};

// Send response
http_response_code($response['statusCode']);
header('Content-Type: application/json');
echo json_encode($response['body']);