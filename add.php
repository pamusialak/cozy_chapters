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

<body>
  <main class="container">
    <?php
    // Include classes
    include_once('inc/validate.php');
    require_once('inc/database.php');

    // Create class objects
    $valid = new Validate();
    $database = new Database();

    if (isset($_POST['Submit'])) {
        // Escape and retrieve form inputs
        $isbn = $valid->escape_string($_POST['isbn']);
        $book_name = $valid->escape_string($_POST['book_name']);
        $authors_name = $valid->escape_string($_POST['authors_name']);
        $number_of_pages = $valid->escape_string($_POST['number_of_pages']);
        $edition = $valid->escape_string($_POST['edition']);
        $publisher = $valid->escape_string($_POST['publisher']);
        $original_language = $valid->escape_string($_POST['original_language']);
        $date_added = $valid->escape_string($_POST['date_added']);

        // Required fields array
        $requiredFields = ['isbn', 'book_name', 'authors_name', 'number_of_pages', 'publisher', 'original_language', 'date_added'];

        // Validate required fields
        $msg = $valid->checkEmpty($_POST, $requiredFields);
        $checkISBN = $valid->validISBN($isbn);
        $checkPages = $valid->validPages($number_of_pages);

        // Handle validation results
        if ($msg != null) {
            echo '<div class="alert alert-danger">' . $msg . '<a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
        } elseif (!$checkISBN) {
            echo '<div class="alert alert-danger"><p>Please provide a valid ISBN.</p><a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
        } elseif (!$checkPages) {
            echo '<div class="alert alert-danger"><p>Please provide a valid number of pages.</p><a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
        } else {
            // If all fields are valid
            $result = $database->execute($isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added);
            if ($result) {
                echo '<div class="alert alert-success"><p>Data added successfully.</p><a href="view.php" class="btn btn-primary">View Result</a></div>';
            } else {
                echo '<div class="alert alert-danger"><p>There was an error adding the data.</p><a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
            }
        }
    }
    ?>
  </main>
</body>
</html>
