<?php
include_once("db-config.php");

//read
$connection_id = mysqli_query($mysqli, "select id from connections where code=\"".$_GET['code']."\"");
$connection_id = $connection_id->fetch_row();
$connection_id = $connection_id[0];

if($connection_id){
	//update
	$result = mysqli_query($mysqli, "UPDATE connections SET url=\"".$_GET['url']."\" WHERE id = '".$connection_id."'");
}else{
	//create
	$result = mysqli_query($mysqli, "INSERT INTO connections (code, url) VALUES (\"".$_GET['code']."\",\"".$_GET['url']."\")");
}

//delete in deleteConnection.php
?>
