<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Page.php';
require_once 'Navigation.php';

$pages = Page::findAll();
$navId = $_GET['id'];
$navigationItem = Navigation::findOne($navId);

if (!$navigationItem instanceof Navigation) {
    //todo klaidos pranesimas
    header('Location:index.php');
    die();
}
include 'header.php';
?>

<div class="container">
<form method="POST">
    <div>
        <label>Title</label>
        <input name="title" type="text" value="<?php echo $navigationItem->getTitle(); ?>" />
    </div>
    <div>
        <label>Page</label>
        <select name="page_id">
        <?php foreach ($pages as $page) { ?>
            <option
                value="<?php echo $page->getId(); ?>"
                <?php if ($page->getId() == $navigationItem->getPage_id()) {echo 'selected';} ?>
             >
                <?php echo $page->getHeading(); ?>
            </option>
        <?php } ?>
        </select>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
</div>

<?php include 'footer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $page_id = isset($_POST['page_id']) ? $_POST['page_id'] : null;

        
    $navigationItem
        ->setTitle($title)
        ->setPageId($page_id)
    ;

    $navigationItem->save();
    header('Location:pageList.php');
    die();
}
?>