<?php declare (strict_types = 1);

require_once 'config.php';

function isLoggedIn(): bool
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true;
}

function addFlashMessage(string $messageType, string $text)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }

    $_SESSION['flash_messages'][] = [
        'type' => $messageType,
        'text' => $text,
    ];
}

function checkLoginAndRedirect(): void
{
    if (!isLoggedIn()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        header('Location:' . BASE_URL . '/login.php');
        addFlashMessage('danger', 'Prisijunkite!');
        exit();
    }
}

function checkPassword(string $password): bool
{
    return password_verify($password, ADMIN_PASSWORD_HASH);
}

function login(): void
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['admin_logged_in'] = true;
}

function logout(): void
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    session_destroy();
}

