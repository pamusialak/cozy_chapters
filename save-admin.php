<?php

	require './inc/database.php';

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];

	$ok = true;
	require './inc/header.php';

		if ($password != $confirm) {
			echo '<p>Invalid passwords</p>';
			$ok = false;
		}

	if ($ok){
		$password = hash('sha512', $password);
	
		$sql = "INSERT INTO phpadmins (first_name, last_name, username, password) 
		VALUES ('$first_name', '$last_name', '$username', '$password');";
		$conn->exec($sql);
		header("Location: signin.php"); 	
	}
	?>

<?php require './inc/footer.php'; ?>
