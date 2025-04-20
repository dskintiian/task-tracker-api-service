<?php
declare(strict_types=1);

namespace App\Task\Repository;

use App\Core\Repository\AbstractRepository;
use App\Task\Entity\Task;

class TaskRepository extends AbstractRepository
{
    public function getEntityClass(): string
    {
        return Task::class;
    }

    public function getEntityPK(): string
    {
        return 'id';
    }
}
