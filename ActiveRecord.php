<?php

require_once 'DBConnectionTrait.php';

abstract class ActiveRecord
{
    use DBConnectionTrait;
    
    protected static $tableName;

    protected $id;

    public function __construct()
    {
        self::loadDatabase();
    }

    abstract public function save(): bool;

    public static function findOne(int $id)
    {
        self::loadDatabase();
        $query = self::$pdo->prepare("SELECT * FROM " . static::$tableName . " WHERE id = :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, static::class);
        return $query->fetch();
    }

    public static function delete($id): bool
    {
        self::loadDatabase();
        $query = self::$pdo->prepare("DELETE FROM " . static::$tableName . " WHERE id = :id ");
        
        return $query->execute(['id' => $id]);
    }

    public static function findAll(): array
    {
        self::loadDatabase();
        $query = self::$pdo->prepare("SELECT * FROM " . static::$tableName);
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, static::class);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}