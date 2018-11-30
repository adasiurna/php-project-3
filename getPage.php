<?php

require_once 'Page.php';

$page_id = $_GET['page_id'];
$page = Page::findOne($page_id);

include 'header.php';
?>
<div class="container">
    <h1><?php echo $page->getHeading(); ?></h1>
    <p><?php echo $page->getContent(); ?></p>
</div>
<?php include 'includes/footer.php'?>
