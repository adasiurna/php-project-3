<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Page.php';
$pages = Page::findAll();
$pageId = $_GET['id'];
$page = Page::findOne($pageId);

if (!$page instanceof Page) {
    //todo klaidos pranesimas
    header('Location:home.php');
    die();
}
include 'header.php';
?>
<div class="container">
<h1><?php echo $page->getHeading(); ?></h1>
<p><?php echo nl2br(htmlspecialchars($page->getContent())); ?></p>
</div>
<?php include 'includes/footer.php'; ?>