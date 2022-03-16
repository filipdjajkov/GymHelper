<?php
if(isset($_COOKIE["email"]))
	setcookie("email", '', time()-3600);
if(isset($_COOKIE["admin"]))
	setcookie("admin", '', time()-3600);
header("location: index.php");
?>
