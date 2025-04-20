<?php
declare(strict_types=1);

namespace App\Core\Storage\Driver;

class InMemoryDriver implements StorageDriverInterface
{
    private static array $collection = [];

    public function saveItem(string $entityName, string $key, mixed $entity): void
    {
        $this->ensureEntityCollection($entityName);

        static::$collection[$entityName][$key] = $entity;
    }

    public function findByPrimaryKey(string $entityName, string $key): mixed
    {
        $this->ensureEntityCollection($entityName);

        return static::$collection[$entityName][$key] ?? null;
    }

    public function getCollection(string $entityName, array $criteria = []): array
    {
        $this->ensureEntityCollection($entityName);

        $collection = static::$collection[$entityName];
        foreach ($criteria as $property => $value) {
            $collection = array_filter(
                $collection,
                static fn($entity) => $entity->$property === $value
            );
        }

        return $collection;
    }

    private function ensureEntityCollection(string $entityName): void
    {
        if (!array_key_exists($entityName, static::$collection)) {
            static::$collection[$entityName] = [];
        }
    }
}
