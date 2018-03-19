<?php

include "ExceptionFTP.php";

class FTPClient{

	private $ipServer;
	private $portServer;
	private $username;
	private $password;
	private $connMode;
	private $connection;
	private $path;

	public function __construct($ipServer,$portServer,$username,$password,$connMode){
		$this->ipServer = $ipServer;
		$this->portServer = $portServer;
		$this->username = $username;
		$this->password = $password;
		$this->connMode = $connMode;
		$this->path = "/";
		$this->init();

	}

	public function getIpServer(){
		return $this->ipServer;
	}

	public function getPortServer(){
		return $this->getPortServer;
	}

	public function getUsername(){
		return $this->getUsername;
	}

	public function getPassword(){
		return $this->getPassword;
	}

	public function getConnMode(){
		return $this->getConnMode;
	}

	public function getActualPath(){
		return $this->path;
	}

	public function setActualPath($path){
		$this->path = $path;
	}

	public function goToPath($path){
		$this->init();

		if(!ftp_chdir($this->connection,$path)){
			throw new ExceptionFTP("That directory doesn't exists.",0,null,"warning");
		} else {
			$this->path = $path;
		}

	}

	public function getFiles(){
		$this->init();
		$dir = $this->getActualPath();

		$items = array();

		if(is_array($children = @ftp_rawlist($this->connection, $dir))){

			foreach($children as $child){
				$chunks = preg_split("/\s+/", $child);
				list($item['permissions'], $item['number'], $item['user'], $item['group'], $item['size'], $item['month'], $item['day'], $item['time'], $item['name']) = $chunks;
				$item['type'] = $chunks[0][0] === 'd' ? 'directory' : 'file';
				array_splice($chunks, 0, 8);
				$items[implode(" ",$chunks)] = $item;
			
			}

			return $items;

		} else {

			throw new ExceptionFTP("Lost connection to the hosting. Please try again.",0,null,"danger");

		}

	}

	public function createFolder($name){
		
		$this->init();
		$name = $this->getActualPath().$name;

		if(ftp_chdir($this->connection,$name)){
			throw new ExceptionFTP("That directory already exists.",0,null,"danger");
		} else {
			
			if(!@ftp_mkdir($this->connection,$name)){
				throw new ExceptionFTP("Can't create the folder.",0,null,"danger");
			}

		}

	}

	private function init(){
		$this->connect();
		$this->login();
		$this->putConnMode();
	}

	private function connect(){
		
		$conn = ftp_connect($this->ipServer,$this->portServer);
		if(!$conn){
			throw new ExceptionFTP("Can't access to the hosting. Please try again later.",0,null,"danger");
		}

		$this->connection = $conn;

	}

	private function login(){

		$login = @ftp_login($this->connection,$this->username,$this->password);

		if(!$login){
			ftp_close($this->connection);
			throw new ExceptionFTP("User credentials are invalid. Please try again.",0,null,"danger");
		}

	}

	private function putConnMode(){

		if($this->connMode == 'passive'){
			return @ftp_pasv($this->connection,true);
		} else if($this->connMode == 'active'){
			return @ftp_pasv($this->connection,false);
		} else {
			ftp_close($this->connection);
			throw new ExceptionFTP("Failed using that connection mode. Please try again.",0,null,"danger");
		}

	}


}

?>