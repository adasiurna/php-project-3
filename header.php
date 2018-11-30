<?php require_once 'functions.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Page.php';
require_once 'Navigation.php';

$pages = Page::findAll();
$navigations = Navigation::findAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visos programavimo paslaugos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet"  type="text/css" media="screen" href="css/font-awesome.min.css">
    <title>Turinio valdymo sistema</title>
</head>
<body>
<header>
    <nav>
        <a href="index.php">Turinio valdymo sistema</a>

        <?php foreach ($navigations as $navigation) { ?>
            <a href="getPage.php?page_id=<?php echo $navigation->getPage_id(); ?>"><?php echo $navigation->getTitle(); ?></a>
        <?php } ?>

    </nav>
    <?php if (!isLoggedIn()) {?>
        <a id="login" href="<?php echo BASE_URL; ?>/login.php">Prisijungti</a>
    <?php }?>
    <?php if (isLoggedIn()) {?>
        <div class="logout">
        <a href="<?php echo BASE_URL; ?>/actions/logout.php">Atsijungti /</a>
        <a href="pageList.php"> Admin</a>
    </div>
    <?php }?>
</header>

<?php

if (isset($_SESSION['flash_messages'])) {
    foreach ($_SESSION['flash_messages'] as $message) {
        $messageType = $message['type'];
        $message = $message['text'];
        include 'flashMessage.php';
    }

    unset($_SESSION['flash_messages']);
}
?>

<main>

