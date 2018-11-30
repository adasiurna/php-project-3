<?php include 'header.php';?>

<div class="container">
    <div class="form-login">
        <h1 class="login-header">Prisijungimas</h1>
        <form action="actions/login.php" method="POST">
            <input type="password" name="password" />
            <input class="btn btn-primary" type="submit" value="Prisijungti" />
        </form>
    </div>
</div>
<?php include 'includes/footer.php';