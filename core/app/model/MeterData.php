<?php
class MeterData {
	public static $tablename = "meter";

	public function MeterData(){
		$this->name = "";
		$this->name_owner = "";
		$this->username = "";
		$this->no_dfa = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name, brand, serie,person,organization,no,start_at,expire_at,phone,email) ";
		$sql .= "value (\"$this->name\",\"$this->brand\",\"$this->serie\",\"$this->person\",\"$this->organization\",\"$this->no\",\"$this->start_at\",\"$this->expire_at\",\"$this->phone\",\"$this->email\")";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k,$v){
		$sql = "delete from ".self::$tablename." where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",name_owner=\"$this->name_owner\",no=\"$this->no\",no_dfa=\"$this->no_dfa\",no_dfc=\"$this->no_dfc\" where id=$this->id";
		Executor::doit($sql);
	}


	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MeterData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MeterData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new MeterData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MeterData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MeterData());
	}


}

?>