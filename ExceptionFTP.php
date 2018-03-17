<?php
	
	class ExceptionFTP extends Exception{

		private $type;
		public function __construct($message, $code = 0, Exception $previous = null, $type){
			$this->type = $type;
			parent::__construct($message,$code);
		}

		public function __toString(){
			return $this->message;
		}

		public function getType(){
			return $this->type;
		}

	}


?>