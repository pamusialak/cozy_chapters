<?php include_once 'database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cozy Chapters | View Books</title>
    <link rel="icon" href="/img/books.png" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="form.php">Add a Book</a></li>
                <li><a href="view.php">All Books</a></li>
                <li><a href="#store">Store</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Book Name</th>
                        <th>Author's Name</th>
                        <th>Pages</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                        <th>Original Language</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $database->getData();
                    if ($result) {
                        while ($r = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$r['isbn']."</td>";
                            echo "<td>".$r['book_name']."</td>";
                            echo "<td>".$r['authors_name']."</td>";
                            echo "<td>".$r['number_of_pages']."</td>";
                            echo "<td>".$r['edition']."</td>";
                            echo "<td>".$r['publisher']."</td>";
                            echo "<td>".$r['original_language']."</td>";
                            echo "<td>".$r['date_added']."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No books found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
