<?php

declare(strict_types=1);

namespace App\Task\Enum;

enum TaskStatusEnum: string
{
    case NEW = 'new';
    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
