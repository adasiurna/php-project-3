<html>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Page.php';

    $heading = isset($_POST['heading']) ? $_POST['heading'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;
    $sort = isset($_POST['sort']) ? $_POST['sort'] : null;

    $page = new Page();
    $page
        ->setContent($content)
        ->setHeading($heading)
        ->setSort($sort)
    ;

    $page->save();

    header('Location:pageList.php');
    die();
}
include 'header.php';
?>
<div class="container">
<form method="POST">
    <div>
        <label>
            Heading
        </label>
        <input name="heading" type="text" />
    </div>
    <div>
        <label>
            Content
        </label>
        <textarea name="content"></textarea>
    </div>
    <div>
        <label>
            Sort
        </label>
        <input name="sort" type="number"/>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
</div>
<?php include 'footer.php';?>