<?php
include_once("db-config.php");

$user_id = mysqli_query($mysqli, "select id from users where email=\"".$_GET['email']."\"");
$user_id = $user_id->fetch_row();
$user_id = $user_id[0];

$connection_id = mysqli_query($mysqli, "select id from connections where code=\"".$_GET['code']."\"");
$connection_id = $connection_id->fetch_row();
$connection_id = $connection_id[0];

$result = mysqli_query($mysqli, "select connection_id from favourites where user_id='".$user_id."' and connection_id='".$connection_id."'");
$result = $result->fetch_row();

echo ($result != null);
/*$result = $result->fetch_row();
if($result == null)
	$result = false;
else
	$result = $result[0];*/

//echo $result;
?>
