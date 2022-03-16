<?php
include_once("db-config.php");

$code = $_GET['code'];

$result = mysqli_query($mysqli, "select url from connections
	where code='$code'");

$row = $result->fetch_row();

echo $row[0];
?>
