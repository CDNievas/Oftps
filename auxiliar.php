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


	function show_message(){
		
		if (isset($_SESSION['message'])) { 
			echo "<div class='alert alert-" . $_SESSION['message']['type']. "'>" . $_SESSION['message']['text'] . "</div>"; 
			unset($_SESSION['message']); 
		}

	}

	function detect_session($exist,$name,$url){

		if($exist){
			if(isset($_SESSION[$name])){
				header("location:".$url);
			}
		} else {
			if(!isset($_SESSION[$name])){
				header("location:".$url);
			}
		}
		
	}

?>