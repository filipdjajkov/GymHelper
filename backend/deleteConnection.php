<?php
include_once("db-config.php");

$connection_id = mysqli_query($mysqli, "select id from connections where code=\"".$_GET['code']."\"");
$connection_id = $connection_id->fetch_row();
$connection_id = $connection_id[0];

$result = mysqli_query($mysqli, "DELETE FROM connections WHERE id='".$connection_id."'");
?>
