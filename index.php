<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Navigation.php';

$allNavigation = Navigation::findAll();
$navigation1 = Navigation::findOne(1);

var_dump($allNavigation);
var_dump($navigation1);