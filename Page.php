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
            $query = self::$pdo->prepare('INSERT INTO ' . self::$tableName . '(heading, content) VALUES(:heading, :content)');
            $result = $query->execute([
                'heading' => $this->heading,
                'content' => $this->content
            ]);
    
            if ($result) {
                $insertedId = self::$pdo->lastInsertId();
                $this->id = $insertedId;
            }
        } else {
            $query = self::$pdo->prepare('UPDATE ' . self::$tableName . ' SET heading=:heading, content=:content WHERE id=:id');
            $result = $query->execute([
                'heading' => $this->heading,
                'content' => $this->content,
                'id' => $this->id
            ]);
        }
        
        return $result;
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