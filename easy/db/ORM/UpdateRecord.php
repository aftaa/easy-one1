<?php

namespace easy\db\ORM;

use easy\db\Connection;
use easy\db\helpers\StorageNameToTableName;
use easy\helpers\QueryTimes;

class UpdateRecord
{
    /**
     * @param Connection $connection
     * @param StorageNameToTableName $storageNameToTableName
     * @param QueryTimes $queryTimes
     */
    public function __construct(
        private Connection             $connection,
        private StorageNameToTableName $storageNameToTableName,
        private QueryTimes             $queryTimes,
    )
    {
    }

    public function update(Entity $object, string $tableName): int
    {
        $classReflection = new \ReflectionClass($object);
        $placeholders = $values = [];

        foreach ($object as $name => $value) {
            $propertyReflection = $classReflection->getProperty($name);
            if ('id' == $name) {
                continue;
            }
            if (empty($value)) {
                continue;
            }

            if (\DateTimeImmutable::class === $propertyReflection->getType()->getName()) {
                $value = $value->format('Y-m-d H:i:s');
            }
            if (\DateTime::class === $propertyReflection->getType()->getName()) {
                $value = $value->format('Y-m-d H:i:s');
            }
            $typeName = $propertyReflection->getType()->getName();
            if (is_object($value) && enum_exists($typeName)) {
                $value = $value->value;
            }

            $values[":$name"] = $value;
            $placeholders[] = "$name = :$name";
        }
        $values[':id'] = $object->id;
        $query[] = "UPDATE $tableName SET ";
        $query[] = join(', ', $placeholders);
        $query[] = "WHERE id=:id";
        $query = join(' ', $query);
        $this->queryTimes->start($query, $values);
        $this->connection->get()->prepare($query)->execute($values);
        $this->queryTimes->stop();
        return (int)$object->id;
    }
}
