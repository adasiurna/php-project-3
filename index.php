<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Navigation.php';
require_once 'Page.php';


// $allNavigation = Navigation::findAll();
$navigation1 = Navigation::findOne(1);

var_dump($navigation1);

$page1 = Page::findOne(1);
var_dump($page1);

// var_dump($allNavigation);
$navigation2 = new Navigation();
$navigation2->setTitle('My title');
$navigation2->setPage_id(1);
var_dump($navigation2);
$navigation2->save();
var_dump($navigation2);
