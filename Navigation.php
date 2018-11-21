<?php

require_once 'ActiveRecord.php';

class Navigation extends ActiveRecord
{
    protected static $tableName = 'navigation';    

    protected $page_id;
    protected $title;

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setPageId($pageId)
    {
        $this->page_id = $pageId;
    }

    /**
     * Get the value of page_id
     */ 
    public function getPage_id()
    {
        return $this->page_id;
    }

    /**
     * Set the value of page_id
     *
     * @return  self
     */ 
    public function setPage_id($page_id)
    {
        $this->page_id = $page_id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    public function save(): bool
    {
        if (!$this->id) {
            $query = self::$pdo->prepare('INSERT INTO ' . self::$tableName . '(page_id, title) VALUES(:page_id, :title)');
            $result = $query->execute([
                'page_id' => $this->page_id,
                'title' => $this->title
            ]);
    
            if ($result) {
                $insertedId = self::$pdo->lastInsertId();
                $this->id = $insertedId;
            }
        } else {
            $query = self::$pdo->prepare('UPDATE ' . self::$tableName . ' SET page_id=:page_id, title=:title WHERE id=:id');
            $result = $query->execute([
                'page_id' => $this->page_id,
                'title' => $this->title,
                'id' => $this->id
            ]);
        }
        
        return $result;
    }
}
