<?php
session_start();
require './inc/header.php';

// check for authentication before we show any data
if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
    session_unset();     // Unset all session variables
    session_destroy();
    header('location: signin.php');
} else {
    // connect to db
    require './inc/database.php';

    // set up query
    $sql = "SELECT * FROM phppeople";

    // run the query and store the results
    $result = $conn->query($sql);


    // close the table
    echo '</table>';

    // Display the username from the session variable if available
    
        $fname = $_COOKIE['firstname'];
		$lname = $_COOKIE['lastname'];
        echo '<p>Welcome back, ' . $fname .' '.$lname. '!</p>';
    

    echo '<a class="btn btn-warning" href="logout.php">Logout</a>';
    echo '</section>';

   
}

require './inc/footer.php';