<?php
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/auth/secure.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>

<body>
    <h1>Welcome on the admin dashboard</h1>
    <a href="../auth/logout.php">logout</a>
    <main>
        <p>Welcome, <?php echo $_SESSION["username"]; ?></p>
        <section>
            <article>
                <a href="buildings/index.php">Manage buildings</a>
            </article>
            <article>
                <a href="categories/index.php">Manage Categories</a>
            </article>
            <article>
                <a href="overview/index.php">Overview of the buildings</a>
            </article>
        </section>
    </main>
</body>

</html>