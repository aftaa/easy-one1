<?php

namespace easy\db\ORM;

use easy\db\Connection;
use easy\db\DBAL\NoQueryResult;
use easy\db\helpers\StorageNameToTableName;
use easy\helpers\QueryTimes;

class InsertRecord
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

    /**
     * @param Entity $object
     * @param string $tableName
     * @return int
     * @throws \ReflectionException
     */
    public function insert(Entity $object, string $tableName): int
    {
        $classReflection = new \ReflectionClass($object);

        foreach ($object as $name => $value) {
            $propertyReflection = $classReflection->getProperty($name);
            if ('id' == $name) {
                continue;
            }
            if (empty($value)) {
                continue;
            }

            $columns[] = "`$name`";
            $placeholders[] = ":$name";

            if (\DateTimeImmutable::class === $propertyReflection->getType()->getName()) {
                $value = $value->format('Y-m-d H:i:s');
            }
            elseif (\DateTime::class === $propertyReflection->getType()->getName()) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $typeName = $propertyReflection->getType()->getName();
            if (\is_object($value) && \enum_exists($typeName)) {
                $value = $value->value;
            }

            $values[":$name"] = $value;
        }
        $query[] = "INSERT INTO `$tableName` (";
        $query[] = \join(', ', $columns);
        $query[] = ") VALUES(";
        $query[] = \join(', ', $placeholders);
        $query[] = ")";
        $query = \join(' ', $query);

        $this->queryTimes->start($query, $values);
        $this->connection->get()->prepare($query)->execute($values);
        $this->queryTimes->stop();
        return (int)$this->connection->get()->lastInsertId();
    }
}
