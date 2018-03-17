<?php
	
	include '../FTPClient.php';
	session_start();
	include "../debug.php";
	include "../auxiliar.php";

	detect_session(false,"ftp","../index.php");

	function goBackPath($path){

		$str = substr($path, 0, -1);

		$pos = strrpos($str,"/",0);
		if($pos === false){
			return $path;
		} else {
			return substr($str,0,$pos+1);
		}

	}

	if(isset($_GET["path"])){
		
		if($_GET["path"] == "."){
			$path = $_SESSION["ftp"]->getActualPath();
		} else if ($_GET["path"] == ".."){

			$path = $_SESSION["ftp"]->getActualPath();
			$path = goBackPath($path);

		} else {

			$path = $_SESSION["ftp"]->getActualPath().$_GET["path"]."/";

		}
		
		try{
			$_SESSION["ftp"]->goToPath($path);
		} catch (ExceptionFTP $e) {
			$_SESSION["ftp"]->goToPath("/");
		}
		
	}

	header("location:index.php");

?>