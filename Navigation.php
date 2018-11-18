<?php

require_once 'ActiveRecord.php';

class Navigation extends ActiveRecord
{
    protected static $tableName = 'page';    
    protected static $columns = [
        'page_id',
        'title'
    ];

    protected $page_id;
    protected $title;

    public function __construct (int $page_id, string $title)
    {
        parent::__construct();
        $this->page_id = $page_id;
        $this->title = $title;
    }

}
