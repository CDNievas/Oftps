<?php

function set_message($text,$type){
	
	/* Valid types:
	- success
	- warning
	- info
	- danger */
	
	$_SESSION['message'] = array(
        'text' => $text,
        'type' => $type
    );
	
}

function show_message() {
	
   	if (isset($_SESSION['message'])) { 
		echo "<div class='alert alert-" . $_SESSION['message']['type']. "'>" . $_SESSION['message']['text'] . "</div>"; 
      	unset($_SESSION['message']); 
	}
	
}

function detect_session(){
	
	if(!isset($_SESSION['conn'])){
		set_message('You must be logged to do that. Please log in.','warning');
		header('location:../index.php');
	}
	
}

?>