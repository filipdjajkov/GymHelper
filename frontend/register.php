<?php
if (isset($_COOKIE["email"])) {
	header("location: index.php");
}
?>
<html>
<head>
    <title>SIMPLE GYM HEPLER | REGISTER</title>
	<link rel="stylesheet" href="style.css">
	<script src="jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#submitButton").click(function() {
				$.ajax({
					type: "POST",
					url: '../backend/register.php',
					data: $("#registerForm").serialize(), // serializes the form's elements.
					success:  function (response) {
						response = JSON.parse(response);
						alert(response.message);
						if(response.status === "success") {
							window.location.href = "login.php";
						} else if(response.status === "error") {
							window.location.href = "register.php";
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
    <form name="form1" id="registerForm">
        <table width="100%">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" id="name" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" id="email" required></td>
            </tr>
				<td>Password</td>
				<td><input type="password" name="password" id="password" required></td>
            </tr>
        </table>
        <button id="submitButton" style="width:100%; margin-top:8px;" type="button" name="register">Register</button>
    </form>
</body>
</html>
