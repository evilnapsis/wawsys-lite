<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="wawsys";
//		$this->user="evilnaps_admin";$this->pass="l00lapal00za";$this->host="localhost";$this->ddbb="evilnaps_watr";
	}

	function connect(){
		$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="wawsys";
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
