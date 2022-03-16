<?php
//session_start();
/*
if (isset($_COOKIE["email"])) {
	echo('<p>');
	echo($_COOKIE["email"]);
	echo('</p>');
	
	if (isset($_COOKIE["admin"])) {
		echo('<p>');
		echo($_COOKIE["admin"]);
		echo('</p>');
	}
}
*/
?>

<html>
<head>
	<title>SIMPLE GYM HEPLER</title>
	<link rel="stylesheet" href="style.css">
	<script src="html5-qrcode.min.js"></script>
	<script src="jquery.min.js"></script>
	<!--script src="https://unpkg.com/html5-qrcode"></script-->
</head>
<body style="text-align:center;">
	<?php
		if (isset($_COOKIE["email"])) {
			echo('
				<h1 id="logout"><a href="logout.php">&lt;-</a></h1>
			');
		}
	?>
	<h1 id="logo">SIMPLE GYM HEPLER</h1>
	
	<div style="text-align:right; margin: 32px 0;">
		<?php
			if (isset($_COOKIE["email"])) {
				if ($_COOKIE["admin"]) {
					echo('<button>ADMIN MODE</button>');
				}else{
					echo('<button onclick="listFavourites()">FAVOURITES &lt;3</button>');
				}
			}else{
				echo('<button><a href="register.php">REGISTER</a></button>&nbsp;&nbsp;&nbsp;<button><a href="login.php">LOGIN</a></button>');
			}
		?>
	</div>		
	<div id="qr-reader" style="width:100%; margin: 32px 0 0 0;"></div>
	<script>
		var code="";
		
		function listFavourites(){
			var xmlHttp = new XMLHttpRequest();
			
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == XMLHttpRequest.DONE) {
					if (xmlHttp.status == 200) {
						alert(xmlHttp.responseText.replaceAll(new RegExp('<br>', 'g'),"\n"));
					}
					else if (xmlHttp.status == 400) {
						alert('There was an error 400');
					}
					else {
						alert('something else other than 200 was returned');
					}
				}
			};
			
			xmlHttp.open( "GET", '../backend/listFavourites.php'+"?"+"email=<?php echo($_COOKIE["email"]);?>", true ); // false for synchronous request
			xmlHttp.send( null );
		}
		
		function toggleFavourite(){
			var xmlHttp = new XMLHttpRequest();
			
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == XMLHttpRequest.DONE) {
					if (xmlHttp.status == 200) {
						if(xmlHttp.responseText==1){
							document.getElementById("favouritesToggle").style.backgroundColor="var(--accent)";
						}else{
							document.getElementById("favouritesToggle").style.backgroundColor="var(--input)";
						}
					}
					else if (xmlHttp.status == 400) {
						alert('There was an error 400');
					}
					else {
						alert('something else other than 200 was returned');
					}
				}
			};
			
			xmlHttp.open( "GET", '../backend/toggleFavourite.php'+"?"+"code="+code+"&email=<?php echo($_COOKIE["email"]);?>", true ); // false for synchronous request
			xmlHttp.send( null );
		}
		
		function favouritesUpdate(){
			var xmlHttp = new XMLHttpRequest();
			
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == XMLHttpRequest.DONE) {
					if (xmlHttp.status == 200) {
						if(xmlHttp.responseText==true){
							document.getElementById("favouritesToggle").style.backgroundColor="var(--accent)";
						}else{
							document.getElementById("favouritesToggle").style.backgroundColor="var(--input)";
						}
					}
					else if (xmlHttp.status == 400) {
						alert('There was an error 400');
					}
					else {
						alert('something else other than 200 was returned');
					}
				}
			};
			
			xmlHttp.open( "GET", '../backend/isFavourite.php'+"?"+"code="+code+"&email=<?php echo($_COOKIE["email"]);?>", true ); // false for synchronous request
			xmlHttp.send( null );
		}
	
		function changeConnection() {
			var xmlHttp = new XMLHttpRequest();
			
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == XMLHttpRequest.DONE) {
					if (xmlHttp.status == 200) {
						onScanSuccess(code, '');
					}
					else if (xmlHttp.status == 400) {
						alert('There was an error 400');
					}
					else {
						alert('something else other than 200 was returned');
					}
				}
			};
			
			xmlHttp.open( "GET", '../backend/changeConnection.php'+"?"+"code="+code+"&url="+document.getElementById('url').value, true ); // false for synchronous request
			xmlHttp.send( null );
		}
		
		function deleteConnection() {
			var xmlHttp = new XMLHttpRequest();
			
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == XMLHttpRequest.DONE) {
					if (xmlHttp.status == 200) {
						onScanSuccess(code, '');
					}
					else if (xmlHttp.status == 400) {
						alert('There was an error 400');
					}
					else {
						alert('something else other than 200 was returned');
					}
				}
			};
			
			xmlHttp.open( "GET", '../backend/deleteConnection.php'+"?"+"code="+code+"&email=<?php echo($_COOKIE["email"]);?>", true ); // false for synchronous request
			xmlHttp.send( null );
		}
	
		function onScanSuccess(decodedText, decodedResult) {
			code = decodedText;
			
			var xmlHttp = new XMLHttpRequest();
			
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
					//const myTimeout = setTimeout(locked = false, 10000);
					if (xmlHttp.status == 200) {
						document.getElementById("video").innerHTML = "";
						if(xmlHttp.responseText){
							document.getElementById("video").innerHTML =
							'<iframe width="480" height="270"'+
							'src="https://www.youtube.com/embed/'+xmlHttp.responseText+'">'+
							'</iframe>';
						}
						if("<?php echo $_COOKIE["admin"] ?>" == true){
							document.getElementById("video").innerHTML=
							document.getElementById("video").innerHTML+
							'<input id="url" type="text" name="url" value="'+xmlHttp.responseText+'" placeholder="enter youtube parameter">'+
							'<button onclick="changeConnection()">SAVE</button>';
							if(xmlHttp.responseText){
								document.getElementById("video").innerHTML=
								document.getElementById("video").innerHTML+
								'<button onclick="deleteConnection()">DELETE</button>';
							}
						}else if("<?php echo $_COOKIE["email"] ?>".length > 6){
							if(xmlHttp.responseText){
								document.getElementById('video').innerHTML=
								document.getElementById('video').innerHTML+
								'<br><button id=\"favouritesToggle\" onclick=\"toggleFavourite()\">&lt;3</button>';
								favouritesUpdate();
							}else{
								alert('Guide not found.');
							}
						}
						$("#video").slideDown();
					}
					else if (xmlHttp.status == 400) {
						alert('There was an error 400');
					}
					else {
						alert('something else other than 200 was returned');
					}
				}
			};
			
			xmlHttp.open( "GET", '../backend/connectionToUrl.php'+"?"+"code="+decodedText, true ); // false for synchronous request
			xmlHttp.send( null );
		}
		var html5QrcodeScanner = new Html5QrcodeScanner(
		"qr-reader", { fps: 10, qrbox: 250 });
		html5QrcodeScanner.render(onScanSuccess);
		
	</script>
	<br><br>
	<div id="video" style="display:none;"></div>
</body>
</html>
