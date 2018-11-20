<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Navigation.php';

$allNavigation = Navigation::findAll();
$navigation1 = Navigation::findOne(1);

var_dump($navigation1);
var_dump($allNavigation);
$navigation2 = new Navigation();
$navigation2->save();

var_dump($navigation2);
