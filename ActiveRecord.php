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
        if (empty(self::$columns)) {
            throw new \Exception('columns field cannot be empty');
        }

        loadDatabase();
    }

    public function save(): bool
    {
        $values = [];
        $parameters = self::$columns;
        foreach ($parameters as &$parameter) {
            if (property_exists($this, $parameter)) {
                $values[$parameter]= $this->$parameter;
            } else {
                $values[$parameter]= null;
            }

            $parameter = ":$parameter";
        }


        $query = self::$pdo->prepare("INSERT INTO {self::$tableName}(" . implode(self::$columns, ', ') . ") VALUES (" . implode($parameters, ',') . ")");
        $result = $query->execute();
        if ($result) {
            $insertedId = self::$pdo->lastInsertId();
            $this->id = $insertedId;
        }
        
        return $result;
    }

    public static function findOne(int $id): array
    {
        if (empty(self::$columns)) {
            throw new \Exception('columns field cannot be empty');
        }

        $query = self::$pdo->prepare("SELECT id," . implode(self::$columns, ', ') . " FROM " . self::$tableName . " WHERE id = :id ");
        $query->execute(['id' => $id]);

        return $query->fetch();
    }

    public static function delete($id): bool
    {

    }

    public static function findAll(): array
    {
        if (empty(self::$columns)) {
            throw new \Exception('columns field cannot be empty');
        }

        $query = self::$pdo->prepare("SELECT id," . implode(self::$columns, ', ') . " FROM " . self::$tableName);
        $query->execute();

        return $query->fetchAll();
    }
}