<?php

require_once 'Page.php';

if (isset($_POST['id'])) {
    Page::delete((int) $_POST['id']);
}

header('Location:pageList.php');