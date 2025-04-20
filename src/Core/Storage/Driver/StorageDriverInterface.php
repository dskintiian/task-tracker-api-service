<?php
declare(strict_types=1);

namespace App\Core\Storage\Driver;

interface StorageDriverInterface
{
    public function saveItem(string $entityName, string $key, mixed $entity);

    public function findByPrimaryKey(string $entityName, string $key);

    public function getCollection(string $entityName, array $criteria);
}
