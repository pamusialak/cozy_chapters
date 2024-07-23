<?php include_once 'inc/database.php'; ?>

<?php require 'inc/header.php'; ?>

<body>
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

<?php require 'inc/footer.php'; ?>

</html>
