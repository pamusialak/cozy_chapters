<?php
include './inc/header.php';
require './inc/database.php';
require_once './functions.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: signin.php');
    exit();
}

if (isset($_GET['isbn'])) {
    $isbn = htmlspecialchars($_GET['isbn']);
    
    $database = new Database();
    $conn = $database->conn;

    // Fetch the existing data
    $stmt = $conn->prepare("SELECT * FROM books WHERE isbn = ?");
    $stmt->bind_param('s', $isbn);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        echo 'Record not found.';
        exit();
    }
} else {
    echo 'No ISBN provided.';
    exit();
}
?>

<h1>Update Book</h1>
<form method="post" action="update_action.php" enctype="multipart/form-data">
    <input type="hidden" name="isbn" value="<?php echo htmlspecialchars($row['isbn']); ?>" />
    <p><input type="text" name="book_name" value="<?php echo htmlspecialchars($row['book_name']); ?>" required /></p>
    <p><input type="text" name="authors_name" value="<?php echo htmlspecialchars($row['authors_name']); ?>" required /></p>
    <p><input type="number" name="number_of_pages" value="<?php echo htmlspecialchars($row['number_of_pages']); ?>" required /></p>
    <p><input type="number" name="edition" value="<?php echo htmlspecialchars($row['edition']); ?>" /></p>
    <p><input type="text" name="publisher" value="<?php echo htmlspecialchars($row['publisher']); ?>" required /></p>
    <p><input type="text" name="original_language" value="<?php echo htmlspecialchars($row['original_language']); ?>" required /></p>
    <p><input type="file" name="image" accept="image/*" /></p>
    <input type="submit" value="Update" />
</form>

<?php require 'inc/footer.php'; ?>
