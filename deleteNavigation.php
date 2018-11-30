<?php

require_once 'Navigation.php';

if (isset($_POST['id'])) {
    Navigation::delete((int) $_POST['id']);
}

header('Location:pageList.php');