<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Page.php';
require_once 'Navigation.php';

$pageItems = Page::findAllSorted();
$navigationItems = Navigation::findAll();

include 'header.php';
?>
<div class="container">
    <h1>All pages <a style="font-size: 24px;" href="createPage.php"> | Create new page |</a> </h1>
    
    <table class="table table-hover table-sm">
    <tr>
        <th>Id</th>
        <th>Heading</th>
        <th>Created</th>
        <th>Sort</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($pageItems as $pageItem) { ?>
    <tr>
        <td><?php echo $pageItem->getId(); ?></td>
        <td><?php echo $pageItem->getHeading(); ?></td>

        <td><?php echo $pageItem->getCreated(); ?></td>
        <td><?php echo $pageItem->getSort(); ?></td>
        <td>
            <a href="editPage.php?id=<?php echo $pageItem->getId(); ?>">Edit</a>
            <a href="viewPage.php?id=<?php echo $pageItem->getId(); ?>">View</a>
            <form method="POST" action="deletePage.php">
                <input type="submit" value="Delete" />
                <input name="id" type="hidden" value="<?php echo $pageItem->getId(); ?>" />
            </form>
        </td>
    </tr>
    <?php } ?>
    </table>


    <h1>Navigation <a style="font-size: 24px;" href="createNavigation.php"> | Create new navigation item |</a></h1>
    <table class="table table-hover table-sm">
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
            <a href="editNavigation.php?id=<?php echo $navigationItem->getId(); ?>">Edit</a>
            <form method="POST" action="deleteNavigation.php">
                <input type="submit" value="Delete" />
                <input name="id" type="hidden" value="<?php echo $navigationItem->getId(); ?>" />
            </form>
        </td>
    </tr>
    <?php } ?>
    </table>
</div>
<?php include 'includes/footer.php'; ?>