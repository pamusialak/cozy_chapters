<?php
include './inc/header.php';
require './inc/database.php';
require_once './inc/functions.php';

$database = new Database();
$conn = $database->conn;

$result = $database->getData();
if ($result) {
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ISBN</th>';
    echo '<th>Book Name</th>';
    echo '<th>Author\'s Name</th>';
    echo '<th>Pages</th>';
    echo '<th>Edition</th>';
    echo '<th>Publisher</th>';
    echo '<th>Original Language</th>';
    echo '<th>Date Added</th>';
    echo '<th>Image</th>';
    echo '<th>Actions</th>'; // Add a column for actions
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($r = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($r['isbn']) . '</td>';
        echo '<td>' . htmlspecialchars($r['book_name']) . '</td>';
        echo '<td>' . htmlspecialchars($r['authors_name']) . '</td>';
        echo '<td>' . htmlspecialchars($r['number_of_pages']) . '</td>';
        echo '<td>' . htmlspecialchars($r['edition']) . '</td>';
        echo '<td>' . htmlspecialchars($r['publisher']) . '</td>';
        echo '<td>' . htmlspecialchars($r['original_language']) . '</td>';
        echo '<td>' . htmlspecialchars($r['date_added']) . '</td>';
        echo '<td><img src="' . htmlspecialchars($r['image']) . '" alt="Book Cover" width="100"></td>';

        // Action links
        echo '<td>';
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo '<a href="update.php?isbn=' . urlencode($r['isbn']) . '">Edit</a> | ';
            echo '<a href="delete.php?isbn=' . urlencode($r['isbn']) . '" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a>';
        } else {
            echo 'N/A';
        }
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<tr><td colspan="10">No books found.</td></tr>';
}

$database->close();
?>

<?php require 'inc/footer.php'; ?>
