<?php
include_once("db-config.php");

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
	$name     = $_POST['name'];
	$email    = $_POST['email'];
	$password = $_POST['password'];

	$query="select email from users where email='$email'";
	$email_result = mysqli_query($mysqli, $query);
	$user_matched = mysqli_num_rows($email_result);

	if (mysqli_num_rows($email_result) > 0) {
		echo json_encode(array(
			'status' => 'error',
			'message'=> 'User already exists with the email'
		));
		//echo "<script>alert('Error: User already exists with the email \"".$email."\".')</script>";
	} else {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$result   = mysqli_query($mysqli, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");

		if ($result) {
			echo json_encode(array(
				'status' => 'success',
				'message'=> 'User registered successfully'
			));
			//echo "<script>alert('User Registered successfully.')</script>";
			//header("location: login.php");
		} else {
			echo json_encode(array(
				'status' => 'error',
				'message'=> 'Registration error, please try again'
			));
			//echo "<script>alert('Registration error. Please try again.')</script>" . mysqli_error($mysqli);
		}
	}
	
}else{
	echo json_encode(array(
		'status' => 'error',
		'message'=> 'Please enter all fields'
	));
}
?>
