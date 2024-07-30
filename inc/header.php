<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author"content="Pamela Alves Musialak">
    <meta name="description"content="Cozy Chapters Social Book Club">
    <link rel="icon" href="/img/books.png" type="image/x-icon"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Cozy Chapters - Bookish's social</title>
</head>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="form.php">Add a Book</a></li>
            <li><a href="allbooks.php">All books</a></li>
            <li><a href="store.php">Store</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="signin.php">Login</a></li>
                <?php endif; ?>
        </ul>
    </nav>

</header>

</html>