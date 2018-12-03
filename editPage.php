<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Page.php';
$pages = Page::findAll();
$pageId = $_GET['id'];
$page = Page::findOne($pageId);

if (!$page instanceof Page) {
    //todo klaidos pranesimas
    header('Location:index.php');
    die();
}
include 'header.php';
?>

<div class="container">
<form method="POST">
    <div>
        <label>Heading</label>
        <input name="heading" type="text" value="<?php echo $page->getHeading(); ?>" />
    </div>
    <div>
        <label>Content</label>
        <textarea name="content"><?php echo nl2br(htmlspecialchars($page->getContent())); ?></textarea>
    </div>
    <div>
        <label>Sort</label>
        <input name="sort" type="number" value="<?php echo $page->getSort(); ?>"/>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
</div>

<?php include 'footer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Page.php';

    $heading = isset($_POST['heading']) ? $_POST['heading'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;
    $sort = isset($_POST['sort']) ? $_POST['sort'] : null;

    var_dump($sort);
    
    $page
        ->setContent($content)
        ->setHeading($heading)
        ->setSort($sort)
    ;

    $page->save();

    echo('----------------------------------<br>');
    var_dump($page);

    header('Location:pageList.php');
    die();
}
?>