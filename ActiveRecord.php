<?php

require_once 'DBConnectionTrait.php';

abstract class ActiveRecord
{
    use DBConnectionTrait;
    
    protected static $columns = [];

    protected static $tableName;

    protected $id;

    public function __construct()
    {
        if (empty(static::$columns)) {
            throw new \Exception('columns field cannot be empty');
        }

        loadDatabase();
    }

    public function save(): bool
    {
        $values = [];
        $parameters = static::$columns;
        foreach ($parameters as &$parameter) {
            if (property_exists($this, $parameter)) {
                $values[$parameter]= $this->$parameter;
            } else {
                $values[$parameter]= null;
            }

            $parameter = ":$parameter";
        }


        $query = self::$pdo->prepare("INSERT INTO {static::$tableName}(" . implode(static::$columns, ', ') . ") VALUES (" . implode($parameters, ',') . ")");
        $result = $query->execute();
        if ($result) {
            $insertedId = self::$pdo->lastInsertId();
            $this->id = $insertedId;
        }
        
        return $result;
    }

    public static function findOne(int $id): array
    {
        if (empty(static::$columns)) {
            throw new \Exception('columns field cannot be empty');
        }

        $query = self::$pdo->prepare("SELECT id," . implode(static::$columns, ', ') . " FROM " . static::$tableName . " WHERE id = :id ");
        $query->execute(['id' => $id]);

        return $query->fetch();
    }

    public static function delete($id): bool
    {

    }

    public static function findAll(): array
    {
        self::loadDatabase();
        if (empty(static::$columns)) {
            throw new \Exception('columns field cannot be empty');
        }

        $query = self::$pdo->prepare("SELECT id," . implode(static::$columns, ', ') . " FROM " . static::$tableName);
        $query->execute();

        return $query->fetchAll();
    }
}