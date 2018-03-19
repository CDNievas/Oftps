<?php

	include 'FTPClient.php';
	session_start();
	include "debug.php";
	include "auxiliar.php";

	function createFolder(){

		$name = $_POST["nameFolder"];

		if(!emptyVars($name)){

			try{
				$_SESSION["ftp"]->createFolder($name);
				set_message("The folder has been created.","success");
				header("location:web/index.php");
			} catch (ExceptionFTP $e){
				set_message($e->getMessage(),$e->getType());
				header("location:web/index.php");
			}
			

		} else {
			set_message("You must complete a name for the new folder.", "warning");
			header("location:web/index.php");	
		}

	}
	
	if(isset($_POST["newFolder"])){
		createFolder();
	} else {
		set_message("Invalid action.", "warning");
		header("location:web/index.php");
	}




?>