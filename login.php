<?php
	
	session_start();
	include "FTPClient.php";
	include "debug.php";
	include "auxiliar.php";
	
	$ipServer = $_POST["ipServer"];
	$portServer = $_POST["portServer"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$connMode = $_POST["connMode"];

	// Generate connection
	if(emptyVars($ipServer,$portServer,$username,$password,$connMode)){
		set_message("Empty fields detected. Please try again.","danger");
		header("location:index.php");
	} else if (illegalChars()){
		set_message("Illegal chars detected. Please try again.","danger");
		header("location:index.php");
	} else {
		
		try {
			$ftp = new FTPClient($ipServer,$portServer,$username,$password,$connMode);
			$_SESSION["ftp"] = $ftp;
			header("location:web/index.php");
		} catch (ExceptionFTP $e){
			set_message($e->getMessage(), $e->getType());
			header("location:index.php");
		}
		
	}


?>