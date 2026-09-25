<?php
/**
 * Modelo para los medidores de agua.
 * Status: 1. Activo, 2. Mantenimiento, 3. Baja
 */
class MeterData {
	public static $tablename = "meter";
	public $id;
	public $identifier;
	public $brand;
	public $serie;
	public $issued_at;
	public $expired_at;
	public $status;
	public $created_at;

	public function __construct(){
		$this->identifier = "";
		$this->brand = "";
		$this->serie = "";
		$this->issued_at = null;
		$this->expired_at = null;
		$this->status = 1;
		$this->created_at = "NOW()";
	}

	private static function db(): \PDO {
		return Database::getPdo();
	}

	public function add(){
		$stmt = self::db()->prepare(
			"insert into ".self::$tablename." (identifier, brand, serie, issued_at, expired_at, status, created_at)
			 values (:identifier, :brand, :serie, :issued_at, :expired_at, :status, NOW())"
		);
		$stmt->execute([
			'identifier' => $this->identifier,
			'brand' => $this->brand,
			'serie' => $this->serie,
			'issued_at' => !empty($this->issued_at) ? $this->issued_at : null,
			'expired_at' => !empty($this->expired_at) ? $this->expired_at : null,
			'status' => $this->status,
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
			"update ".self::$tablename." 
			 set identifier = :identifier, brand = :brand, serie = :serie,
			     issued_at = :issued_at, expired_at = :expired_at, status = :status
			 where id = :id"
		);
		$stmt->execute([
			'identifier' => $this->identifier,
			'brand' => $this->brand,
			'serie' => $this->serie,
			'issued_at' => !empty($this->issued_at) ? $this->issued_at : null,
			'expired_at' => !empty($this->expired_at) ? $this->expired_at : null,
			'status' => $this->status,
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

	public static function getByIdentifier($identifier){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where identifier = :identifier");
		$stmt->execute(['identifier' => $identifier]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		$found = $stmt->fetch();
		return $found ?: null;
	}

	public static function getAll(){
		$stmt = self::db()->query("select * from ".self::$tablename." order by id desc");
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function getAllByStatus($status){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where status = :status order by identifier asc");
		$stmt->execute(['status' => $status]);
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	/**
	 * Retorna medidores activos que NO estén asignados a ningún cliente,
	 * o que estén asignados al $currentClientId indicado.
	 */
	public static function getAvailableForClient($currentClientId = null){
		if ($currentClientId) {
			$sql = "select m.* from ".self::$tablename." m
			        left join client c on c.meter_id = m.id
			        where (c.id is null or c.id = :client_id) and m.status = 1
			        order by m.identifier asc";
			$stmt = self::db()->prepare($sql);
			$stmt->execute(['client_id' => $currentClientId]);
		} else {
			$sql = "select m.* from ".self::$tablename." m
			        left join client c on c.meter_id = m.id
			        where c.id is null and m.status = 1
			        order by m.identifier asc";
			$stmt = self::db()->query($sql);
		}
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function countAll(): int {
		$stmt = self::db()->query("select count(*) from ".self::$tablename);
		return (int) $stmt->fetchColumn();
	}

	public static function countByStatus(int $status): int {
		$stmt = self::db()->prepare("select count(*) from ".self::$tablename." where status = :status");
		$stmt->execute(['status' => $status]);
		return (int) $stmt->fetchColumn();
	}

	public function getStatusLabel(): string {
		switch ((int)$this->status) {
			case 1: return "Activo";
			case 2: return "Mantenimiento";
			case 3: return "Baja";
			default: return "Desconocido";
		}
	}

	public function getStatusBadge(): string {
		switch ((int)$this->status) {
			case 1: return "success";
			case 2: return "warning";
			case 3: return "danger";
			default: return "secondary";
		}
	}
}
?>
