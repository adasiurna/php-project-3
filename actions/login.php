<?php

require_once '../functions.php';

if (isLoggedIn()) {
    header('Location:' . BASE_URL . '/pageList.php');
    exit();
}

if (isset($_POST['password'])) {
    if (checkPassword($_POST['password'])) {
        login();
        header('Location:' . BASE_URL . '/pageList.php');
        exit();
    }
}

addFlashMessage('danger', 'Slaptažodis neteisingas!');
header('Location:' . BASE_URL . '/login.php');
