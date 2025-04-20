<?php
declare(strict_types=1);

namespace App\Core\Repository;

use App\Core\Entity\SoftDeletableInterface;
use App\Core\Storage\Driver\StorageDriverInterface;

abstract class AbstractRepository
{
    public function __construct(private readonly StorageDriverInterface $driver)
    {
    }

    abstract function getEntityClass(): string;

    abstract function getEntityPK(): string;

    public function find(string $id): mixed
    {
        return $this->driver->findByPrimaryKey($this->getEntityClass(), $id);
    }

    public function findAll(array $criteria = []): array
    {
        return $this->driver->getCollection($this->getEntityClass(), $criteria);
    }

    public function save(mixed $entity): void
    {
        $getPKMethod = 'get' . ucfirst($this->getEntityPK());
        $this->driver->saveItem($this->getEntityClass(), $entity->$getPKMethod(), $entity);
    }
}
