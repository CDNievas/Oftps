<?php

class ConnParam{

	private $ipServer;
	private $portServer;
	private $username;
	private $password;
	private $connMode;

	public function __construct($ipServer,$portServer,$username,$password,$connMode){
		$this->ipServer = $ipServer;
		$this->portServer = $portServer;
		$this->username = $username;
		$this->password = $password;
		$this->connMode = $connMode;
	}
	
	public function getConnection(){
		
		if($this->emptyFields()){
			return 1;
		} else if ($this->illegalChars()){
			return 2;
		} else {
			
			$conn = $this->generateConn();
			
			if(!($conn)){
				return 3;
			} else {
				
				if(!($this->login($conn))){
					ftp_close($conn);
					return 4;
				} else {
					
					echo $conn;
					if(!($this->putConnMode($conn))){
						ftp_close($conn);
						return 5;
					} else {
						return $conn;
					}
					
				}
				
				
			}
			
		}
		
	}
	
	// Check empty fields
	private function emptyFields(){
		
		if(!empty($ipServer) || !empty($portServer) || !empty($username) || !empty($password) || !empty($connMode)){
			
			if(isset($ipServer) || isset($portServer) || isset($username) || isset($password) || isset($connMode)){
				return true;
			} else {
				return false;
			}
		
		} else {
			return false;
		}
		
	}
	
	private function illegalChars(){
		return false;	
	}
	
	public function generateConn(){
		return ftp_connect($this->ipServer,$this->portServer);	
	}
				   
	private function login($conn){
		return ftp_login($conn,$this->username,$this->password);
	}
	
	private function putConnMode($conn){
		
		if($this->connMode == 'passive'){
			return ftp_pasv($conn,true);
		} else if($this->connMode == 'active'){
			return ftp_pasv($conn,false);
		} else {
			return false;
		}
		
	}
	
	
	
}

?>