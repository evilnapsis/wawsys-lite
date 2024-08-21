<?php
class WellData {
	public static $tablename = "well";

	public function WellData(){
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (lat,lng,zoom,name,no,address,franchise_id,w_id,diam,capacity_gpm,kt,depth,r_id,r,kmt, brand,serie, digits, unit, factor, created_at) ";
		$sql .= "value (\"$this->lat\",\"$this->lng\",\"$this->zoom\",\"$this->name\",\"$this->no\",\"$this->address\",\"$this->franchise_id\",\"$this->w_id\",\"$this->diam\",\"$this->capacity_gpm\",\"$this->kt\",\"$this->depth\",\"$this->r_id\",\"$this->r\",\"$this->kmt\",\"$this->brand\",\"$this->serie\",\"$this->digits\",\"$this->unit\",\"$this->factor\",NOW())";
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
		$sql = "update ".self::$tablename." set lat=\"$this->lat\",lng=\"$this->lng\",zoom=\"$this->zoom\",name=\"$this->name\",no=\"$this->no\",address=\"$this->address\",franchise_id=\"$this->franchise_id\",w_id=\"$this->w_id\",capacity_gpm=\"$this->capacity_gpm\",kt=\"$this->kt\",depth=\"$this->depth\",r_id=\"$this->r_id\",r=\"$this->r\",kmt=\"$this->kmt\",brand=\"$this->brand\",serie=\"$this->serie\",digits=\"$this->digits\",unit=\"$this->unit\",factor=\"$this->factor\" where id=$this->id";
		Executor::doit($sql);
	}


	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new WellData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new WellData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new WellData());
	}

	public static function getAllByF($f){
		 $sql = "select * from ".self::$tablename." where franchise_id=$f";
		$query = Executor::doit($sql);
		return Model::many($query[0],new WellData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new WellData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new WellData());
	}


}

?>