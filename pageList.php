<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Page.php';
$pages = Page::findAll();
var_dump($pages);
?>

<html>
<body>
    <h1>All pages</h1>
    <table border="4">
    <tr>
        <th>Id</th>
        <th>Heading</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($pages as $page) { ?>
    <tr>
        <td><?php echo $page->getId(); ?></td>
        <td><?php echo $page->getHeading(); ?></td>

        <td><?php echo $page->getCreated(); ?></td>
        <td>
            <form method="POST" action="deletePage.php">
                <input type="submit" value="Delete" />
                <input type="hidden" value="<?php $page->getId(); ?>" />
            </form>
            <a href="editPage.php?id=<?php echo $page->getId(); ?>">Edit</a>
        </td>
    </tr>
    <?php } ?>
    </table>
</body>
</html>