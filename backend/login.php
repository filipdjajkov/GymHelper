<?php
include_once("db-config.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($mysqli, "select password, admin from users where email='$email'");
	
    $user_matched = mysqli_num_rows($result);

    if ($user_matched > 0) {
		$row = $result->fetch_row();
		if(password_verify($password, $row[0])) {
			echo json_encode(array(
				'status' => 'success',
				'message'=> 'User logged in successfully',
				'email'=> $email,
				'admin'=> $row[1]
			));
			return;
		}
    }
    
	echo json_encode(array(
		'status' => 'error',
		'message'=> 'User email or password is not matched'.$email
	));
}
?>
