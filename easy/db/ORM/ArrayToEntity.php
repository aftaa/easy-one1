<?php

namespace easy\db\ORM;

use easy\Application;

class ArrayToEntity
{
    /**
     * @param string $entityName
     * @param array $data
     * @return Entity
     * @throws \Exception
     */
    public function transform(string $entityName, array $data): Entity
    {

        $entity = new $entityName();
        $reflectionClass = new \ReflectionObject($entity);
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyType = $property->getType();
            switch ($propertyType->getName()) {
                case 'int':
                case 'integer':
                case 'float':
                case 'double':
                case 'string':
                case 'bool':


                    if (!$data[$propertyName] && $propertyType->allowsNull()) {
                        $entity->$propertyName = null;
                    } else {
                        $entity->$propertyName = $data[$propertyName];
                    }
                    continue 2;
                case \DateTime::class:
                    if (!$data[$propertyName] && $propertyType->allowsNull()) {
                        $entity->$propertyName = null;
                    } else {
                        $entity->$propertyName = new \DateTime($data[$propertyName] ?? 'now');
                    }
                    continue 2;
                case \DateTimeImmutable::class:
                    if (!$data[$propertyName] && $propertyType->allowsNull()) {
                        $entity->$propertyName = null;
                    } else {
                        $entity->$propertyName = new \DateTimeImmutable($data[$propertyName] ?? 'now');
                    }
                    continue 2;
            }

            if (enum_exists($propertyType->getName())) {
                $typename = $propertyType->getName();
                $value = isset($data[$propertyName]) ? $data[$propertyName] : null;
                $entity->$propertyName = $value ? $typename::from($value) : null;
            } elseif (class_exists($propertyType->getName())) {
                continue 1;
                $entity->$propertyName = $this->getColumnValue($entity, $propertyType);
            }
        }
        return $entity;
    }

    /**
     * @param Entity $entity
     * @param \ReflectionNamedType $propertyType
     * @return Entity
     */
    private function getColumnValue(Entity $entity, \ReflectionNamedType $propertyType): Entity
    {
        $className = $propertyType->getName();
        $storageName = str_replace('entities', 'storages', $className);
        $columnName = strtolower(str_replace('app\storages\\', '', $storageName)) . '_id';
        $storageName .= 'Storage';
        $storage = Application::$serviceContainer->init($storageName);
        return $storage->load($entity->$columnName)->asEntity();
    }
}
