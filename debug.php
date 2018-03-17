<?php
	
	ini_set('display_errors','On');
	error_reporting(E_ALL | E_STRICT);

	function debug(...$messages){
		$msgs = "";
		foreach($messages as $msg){
			$msgs .= json_encode($msg);
			echo "<pre>";
			var_dump($msg);
			echo "</pre>";
		}
		echo '<script>console.log('.json_encode($msgs).')</script>';
		exit(0);
	}

?>