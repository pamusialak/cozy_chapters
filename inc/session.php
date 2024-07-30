<?php
session_start(); // Start the session

require_once './inc/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = hash('sha512', $_POST['password']);

    $database = new Database();
    $conn = $database->conn;

    $sql = "SELECT user_id, username, first_name, last_name FROM phpadmins 
            WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        $_SESSION['timeout'] = time() + 60;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];

        setcookie('firstname', $row['first_name'], time() + 60, '/'); // 1 minute
        setcookie('lastname', $row['last_name'], time() + 120, '/'); // 2 minutes


        header('Location: ../display-person.php');
        exit();
    } else {
        echo 'Invalid Login';
    }

    $stmt->close();
    $database->close();
} else {
    echo 'Invalid Request Method';
}