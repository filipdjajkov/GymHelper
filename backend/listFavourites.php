<?php
include_once("db-config.php");

$user_id = mysqli_query($mysqli, "select id from users where email=\"".$_GET['email']."\"");
$user_id = $user_id->fetch_row();
$user_id = $user_id[0];

$result = mysqli_query($mysqli, "select connection_id from favourites where user_id='".$user_id."'");
$result = $result->fetch_all();
//$result = $result[0];

if($result==null){
	echo 'Empty favourites list';
	return;
}

echo 'Favourites list:<br>';
for($i=0; $i<count($result); ++$i){
	$url = mysqli_query($mysqli, "select code, url from connections where id=\"".$result[$i][0]."\"");
	$url = $url->fetch_row();
	echo '<br>'.$url[0].' | https://www.youtube.com/watch?v='.$url[1];
}
?>
