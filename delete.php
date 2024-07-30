<?php
include './inc/database.php';
require_once './inc/functions.php';
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: signin.php');
    exit();
}

if (isset($_GET['isbn'])) {
    $isbn = htmlspecialchars($_GET['isbn']);

    $database = new Database();
    $conn = $database->conn;

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM books WHERE isbn = ?");
    $stmt->bind_param('s', $isbn);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record.";
    }
    $stmt->close();
    $database->close();

    // Redirect to the list page
    header('Location: allbooks.php');
    exit();
} else {
    echo 'No ISBN provided.';
}
?>
