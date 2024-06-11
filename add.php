<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cozy Chapters | Bookish' social</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
  <main class="container">
    <?php
    // Include classes
    include_once('validate.php');
    require_once('database.php');

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
