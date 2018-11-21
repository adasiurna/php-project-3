<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Page.php';
require_once 'Navigation.php';

$pages = Page::findAllSorted();
$navigationItems = Navigation::findAll();
?>

<html>
<body>
    <h1>All pages</h1>
    <p>
        <a href="createPage.php">Create new page</a>
    </p>
    <table border="4">
    <tr>
        <th>Id</th>
        <th>Heading</th>
        <th>Created</th>
        <th>Sort</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($pages as $page) { ?>
    <tr>
        <td><?php echo $page->getId(); ?></td>
        <td><?php echo $page->getHeading(); ?></td>

        <td><?php echo $page->getCreated(); ?></td>
        <td><?php echo $page->getSort(); ?></td>
        <td>
            <form method="POST" action="deletePage.php">
                <input type="submit" value="Delete" />
                <input name="id" type="hidden" value="<?php echo $page->getId(); ?>" />
            </form>
            <a href="editPage.php?id=<?php echo $page->getId(); ?>">Edit</a>
            <a href="viewPage.php?id=<?php echo $page->getId(); ?>">View</a>
        </td>
    </tr>
    <?php } ?>
    </table>


    <h1>Navigation</h1>
    <p>
        <a href="createNavigation.php">Create new navigation item</a>
    </p>
    <table border="4">
    <tr>
        <th>Id</th>
        <th>Page id</th>
        <th>Title</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($navigationItems as $navigationItem) { ?>
    <tr>
        <td><?php echo $navigationItem->getId(); ?></td>
        <td><?php echo $navigationItem->getPage_id(); ?></td>

        <td><?php echo $navigationItem->getTitle(); ?></td>
        <td>
            <form method="POST" action="deletePage.php">
                <input type="submit" value="Delete" />
                <input name="id" type="hidden" value="<?php echo $navigationItem->getId(); ?>" />
            </form>
            <a href="editNavigation.php?id=<?php echo $navigationItem->getId(); ?>">Edit</a>
            <a href="viewNavigation.php?id=<?php echo $navigationItem->getId(); ?>">View</a>
        </td>
    </tr>
    <?php } ?>
    </table>

</body>
</html>