<?php
/**
 * Modelo para las categorías de consumo de agua (sustituye a la tabla 'k').
 */
class CategoryData {
	public static $tablename = "category";
	public $id;
	public $name;
	public $description;
	public $created_at;

	public function __construct(){
		$this->name = "";
		$this->description = "";
		$this->created_at = "NOW()";
	}

	private static function db(): \PDO {
		return Database::getPdo();
	}

	public function add(){
		$stmt = self::db()->prepare(
			"insert into ".self::$tablename." (name, description, created_at) values (:name, :description, NOW())"
		);
		$stmt->execute([
			'name' => $this->name,
			'description' => $this->description,
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
			"update ".self::$tablename." set name = :name, description = :description where id = :id"
		);
		$stmt->execute([
			'name' => $this->name,
			'description' => $this->description,
			'id' => $this->id,
		]);
	}

	public static function getById($id){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where id = :id");
		$stmt->execute(['id' => $id]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		$found = $stmt->fetch();
		return $found ?: null;
	}

	public static function getAll(){
		$stmt = self::db()->query("select * from ".self::$tablename." order by name asc");
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function getLike($q){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where name like :q order by name asc");
		$stmt->execute(['q' => '%'.$q.'%']);
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function countAll(): int {
		$stmt = self::db()->query("select count(*) from ".self::$tablename);
		return (int) $stmt->fetchColumn();
	}
}
?>
