<?php
/**
 * Modelo para administrar variables y opciones globales de configuración en BD.
 */
class ConfigurationData {
	public static $tablename = "configuration";
	public $id;
	public $short;
	public $name;
	public $kind;
	public $val;

	public function __construct(){
		$this->short = "";
		$this->name = "";
		$this->kind = 2;
		$this->val = "";
	}

	private static function db(): \PDO {
		return Database::getPdo();
	}

	public function add(){
		$stmt = self::db()->prepare(
			"insert into ".self::$tablename." (short, name, kind, val) values (:short, :name, :kind, :val)"
		);
		$stmt->execute([
			'short' => $this->short,
			'name' => $this->name,
			'kind' => $this->kind,
			'val' => $this->val,
		]);
		$this->id = self::db()->lastInsertId();
	}

	public static function delById($id){
		$stmt = self::db()->prepare("delete from ".self::$tablename." where id = :id");
		$stmt->execute(['id' => $id]);
	}

	public function del(){
		self::delById($this->id);
	}

	public function update(){
		$stmt = self::db()->prepare(
			"update ".self::$tablename." set val = :val where id = :id"
		);
		$stmt->execute([
			'val' => $this->val,
			'id' => $this->id,
		]);
	}

	public static function getById($id){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where id = :id");
		$stmt->execute(['id' => $id]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		return $stmt->fetch() ?: null;
	}

	public static function getByShort($short){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where short = :short");
		$stmt->execute(['short' => $short]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		return $stmt->fetch() ?: null;
	}

	public static function getAll(){
		$stmt = self::db()->query("select * from ".self::$tablename." order by id asc");
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}
}
?>