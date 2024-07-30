<?php include './inc/header.php'; ?>

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

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
                $image_path = $target_file;

                // Insert the record into the database
                $result = $database->execute($isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added, $image_path);
                if ($result) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $result;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Validate required fields
        $requiredFields = ['isbn', 'book_name', 'authors_name', 'number_of_pages', 'publisher', 'original_language', 'date_added'];
        $msg = $valid->checkEmpty($_POST, $requiredFields);
        $checkISBN = $valid->validISBN($isbn);
        $checkPages = $valid->validPages($number_of_pages);

        if ($msg != null) {
            echo '<div class="alert alert-danger">' . $msg . '<a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
        } elseif (!$checkISBN) {
            echo '<div class="alert alert-danger"><p>Please provide a valid ISBN.</p><a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
        } elseif (!$checkPages) {
            echo '<div class="alert alert-danger"><p>Please provide a valid number of pages.</p><a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
        } else {
            $result = $database->execute($isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added, $image);
            if ($result) {
                echo '<div class="alert alert-success"><p>Data added successfully.</p><a href="allbooks.php" class="btn btn-primary">Books</a></div>';
            } else {
                echo '<div class="alert alert-danger"><p>There was an error adding the data.</p><a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
            }
        }


        // Required fields array
        $requiredFields = ['isbn', 'book_name', 'authors_name', 'number_of_pages', 'publisher', 'original_language', 'date_added', 'image'];

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
            $result = $database->execute($isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added, $image);
            if ($result) {
                echo '<div class="alert alert-success"><p>Data added successfully.</p><a href="allbooks.php" class="btn btn-primary">Books</a></div>';
            } else {
                echo '<div class="alert alert-danger"><p>There was an error adding the data.</p><a href="javascript:self.history.back();" class="btn btn-secondary">Go Back</a></div>';
            }
        }
    }

    $database->close();
    ?>
  </main>
</body>
</html>

<?php include 'inc/footer.php'; ?>
