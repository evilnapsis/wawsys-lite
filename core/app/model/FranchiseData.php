<?php
class FranchiseData {
	public static $tablename = "franchise";
	public $created_at;

	public function FranchiseData(){
		$this->name = "";
		$this->name_owner = "";
		$this->username = "";
		$this->no_dfa = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (caudal, kind_tariff, tariff,name,name_owner,no,no_dfa,no_dfc,k_id,start_at,expire_at,kind_drna,f_address,f_city,f_country_id,f_cp,p_address,p_city,p_country_id,p_cp,da,da_kind,da_year,da_total,da_no,created_at) ";
echo		$sql .= "value (\"$this->caudal\",\"$this->kind_tariff\",\"$this->tariff\",\"$this->name\",\"$this->name_owner\",\"$this->no\",\"$this->no_dfa\",\"$this->no_dfc\",\"$this->k_id\",\"$this->start_at\",\"$this->expire_at\",\"$this->kind_drna\",\"$this->f_address\",\"$this->f_city\",\"$this->f_country_id\",\"$this->f_cp\",\"$this->p_address\",\"$this->p_city\",\"$this->p_country_id\",\"$this->p_cp\",\"$this->da\",\"$this->da_kind\",\"$this->da_year\",\"$this->da_total\",\"$this->da_no\",NOW())";
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
		$sql = "update ".self::$tablename." set caudal=\"$this->caudal\",kind_tariff=\"$this->kind_tariff\",tariff=\"$this->tariff\",name=\"$this->name\",name_owner=\"$this->name_owner\",no=\"$this->no\",no_dfa=\"$this->no_dfa\",no_dfc=\"$this->no_dfc\",k_id=\"$this->k_id\",start_at=\"$this->start_at\",expire_at=\"$this->expire_at\",kind_drna=\"$this->kind_drna\",f_address=\"$this->f_address\",f_city=\"$this->f_city\",f_country_id=\"$this->f_country_id\",f_cp=\"$this->f_cp\",p_address=\"$this->p_address\",p_city=\"$this->p_city\",p_country_id=\"$this->p_country_id\",p_cp=\"$this->p_cp\",da=\"$this->da\",da_no=\"$this->da_no\",da_year=\"$this->da_year\",da_total=\"$this->da_total\",da_kind=\"$this->da_kind\" where id=$this->id";
		Executor::doit($sql);
	}


	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new FranchiseData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new FranchiseData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new FranchiseData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new FranchiseData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new FranchiseData());
	}


}

?>