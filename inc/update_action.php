<?php
require 'inc/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = htmlspecialchars($_POST['isbn']);
    $book_name = htmlspecialchars($_POST['book_name']);
    $authors_name = htmlspecialchars($_POST['authors_name']);
    $number_of_pages = htmlspecialchars($_POST['number_of_pages']);
    $edition = htmlspecialchars($_POST['edition']);
    $publisher = htmlspecialchars($_POST['publisher']);
    $original_language = htmlspecialchars($_POST['original_language']);

    $database = new Database();
    $conn = $database->conn;

    // Handle file upload
    $image_path = '';
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Prepare the update statement
    if ($image_path) {
        $stmt = $conn->prepare("UPDATE books SET book_name = ?, authors_name = ?, number_of_pages = ?, edition = ?, publisher = ?, original_language = ?, image = ? WHERE isbn = ?");
        $stmt->bind_param('ssssssss', $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $image_path, $isbn);
    } else {
        $stmt = $conn->prepare("UPDATE books SET book_name = ?, authors_name = ?, number_of_pages = ?, edition = ?, publisher = ?, original_language = ? WHERE isbn = ?");
        $stmt->bind_param('sssssss', $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $isbn);
    }
    
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record.";
    }
    $stmt->close();
    $database->close();
} else {
    echo 'Invalid Request Method';
}
