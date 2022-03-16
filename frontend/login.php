<?php
//session_start();

if (isset($_COOKIE["email"])) {
	header("location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>SIMPLE GYM HEPLER | LOGIN</title>
	<link rel="stylesheet" href="style.css">
	<script src="jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#submitButton").click(function() {
				$.ajax({
					type: "POST",
					url: '../backend/login.php',
					data: $("#loginForm").serialize(), // serializes the form's elements.
					success:  function (response) {
						response = JSON.parse(response);
						alert(response.message);
						if(response.status === "success") {
							//$_SESSION["email"] = $email;
							//$_SESSION["admin"] = $row[1];
							document.cookie = "email="+response.email; 
							document.cookie = "admin="+response.admin; 
							//sessionStorage.setItem("email", response.email);
							//sessionStorage.setItem("admin", response.admin);
							window.location.href = "index.php";
						} else if(response.status === "error") {
							window.location.href = "login.php";
						}
					}
				});
			});
		});
	</script>
</head>

<body>
	<h1 id="back"><a href="index.php">&lt;</a></h1>
	<h1 id="logo">SIMPLE GYM HEPLER</h1>
    <br>
    <form name="form1" id="loginForm">
        <table width="100%">
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
        </table>
        <button id="submitButton" style="width:100%; margin-top:8px;" type="button" name="login">Login</button>
    </form>
</body>

</html>
