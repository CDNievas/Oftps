<?php
	
session_start();
include "auxiliar.php";
detect_session(true,"ftp","web/index.php");

?>


<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>Oftps</title>
		
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/login.css" rel="stylesheet">
	</head>
	<body>
		
		<div class="container">
			
			<?php
				show_message();
			?>
			
			<div class="signin">
				
				<h1 class="logo">Oftps</h1>
				<h4 class="logo">An Online FTP client Service</h4>
				
				<hr>

				<h5 class="signin">Connect with your hosting:</h5>
				<form action="login.php" method="post">
					
					<input type="text" class="form-control ip" name="ipServer" placeholder="IP Server" value="files.000webhost.com">
					<input type="text" class="form-control port" name="portServer" placeholder="Port Server" value="21">
					<input type="text" class="form-control username" name="username" placeholder="Username" value="cdnievas">
					<input type="password" class="form-control password" name="password" placeholder="Password" value="banfield123">
					
					<hr>
					
					<h6>Connection mode</h6>
					<label class="radio-inline"><input type="radio" name="connMode" value="active" checked>Pasive client</label>
					<label class="radio-inline"><input type="radio" name="connMode" value="passive">Active client</label>
					
					<button class="btn btn-lg btn-primary btn-block signin" type="submit">Sign in</button>

				</form>
			</div>
		</div>
	
	</body>
</html>