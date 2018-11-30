<?php

require_once 'ActiveRecord.php';

class Page extends ActiveRecord
{
    protected static $tableName = 'page';
    protected $heading;
    protected $content;
    protected $created;
    protected $sort;

    /**
     * Get the value of heading
     */ 
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set the value of heading
     *
     * @return  self
     */ 
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */ 
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    public function save(): bool
    {
        if (!$this->id) {
            $query = self::$pdo->prepare('INSERT INTO ' . self::$tableName . '(heading, content, sort) VALUES(:heading, :content, :sort)');
            $result = $query->execute([
                'heading' => $this->heading,
                'content' => $this->content,
                'sort' => $this->sort
            ]);
    
            if ($result) {
                $insertedId = self::$pdo->lastInsertId();
                $this->id = $insertedId;
            }
        } else {
            $query = self::$pdo->prepare('UPDATE ' . self::$tableName . ' SET heading=:heading, content=:content, sort=:sort WHERE id=:id');
            $result = $query->execute([
                'heading' => $this->heading,
                'content' => $this->content,
                'sort' => $this->sort,
                'id' => $this->id
            ]);
        }
        
        return $result;
    }

    public static function findAllSorted()
    {
        self::loadDatabase();
        $query = self::$pdo->prepare("SELECT * FROM page ORDER BY sort DESC");
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, static::class);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get the value of sort
     */ 
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set the value of sort
     *
     * @return  self
     */ 
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }
}