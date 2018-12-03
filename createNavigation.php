<html>
<body>
<?php
    require_once 'Page.php';
    $pages = Page::findAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        require_once 'Navigation.php';

        $pageId = isset($_POST['page_id']) ? $_POST['page_id'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;

        $navigation = new Navigation();

        $navigation
            ->setTitle($title)
            ->setPageId($pageId)
        ;

        $navigation->save();
        
        header('Location:pageList.php');
        die();
    }

    include 'header.php';
?>
<form method="POST">
    <div>
        <label>
            Page
        </label>
        <select name="page_id" >
        <?php foreach ($pages as $page) {?>
            <option value="<?php echo $page->getId(); ?>">
                <?php echo $page->getHeading(); ?>
            </option>
        <?php }?>
        </select>
    </div>
    <div>
        <label>
            Title
        </label>
        <input name="title" />
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php 
include 'footer.php';
?>