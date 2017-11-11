<?php

include 'functions.php';
include 'ConnParam.php';

session_start();

$connParam = new ConnParam($_POST['ipServer'],$_POST['portServer'],$_POST['username'],$_POST['password'],$_POST['connMode']);

$conn = $connParam->getConnection();

switch($conn){
	
	case 1:
		set_message("Empty fields detected. Please try again.","danger");
		header("location:index.php");
		break;
	
	case 2:
		set_message("Illegal chars detected. Please try again.","danger");
		header("location:index.php");
		break;
	
	case 3:
		set_message("Can't access to the hosting. Please try again later.","danger");
		header("location:index.php");
		break;
	
	case 4:
		set_message("User credentials are invalid. Please try again.","danger");
		header("location:index.php");
		break;
		
	case 5:
		set_message("Failed using that connection mode. Please try again.","danger");
		header("location:index.php");
		break;
		
	default:
		$_SESSION['conn'] = $conn;
		header("location:web/index.php");
		
}

?>