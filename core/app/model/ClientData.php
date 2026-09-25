<?php
/**
 * Modelo para los clientes (abonados del servicio de agua).
 * Status: 1. Activo, 2. Suspendido, 3. Cancelado
 */
class ClientData {
	public static $tablename = "client";
	public $id;
	public $code;
	public $name;
	public $lastname;
	public $dni;
	public $phone;
	public $email;
	public $address;
	public $location_id;
	public $category_id;
	public $meter_id;
	public $status;
	public $created_at;

	public function __construct(){
		$this->code = "";
		$this->name = "";
		$this->lastname = "";
		$this->dni = "";
		$this->phone = "";
		$this->email = "";
		$this->address = "";
		$this->location_id = null;
		$this->category_id = null;
		$this->meter_id = null;
		$this->status = 1;
		$this->created_at = "NOW()";
	}

	private static function db(): \PDO {
		return Database::getPdo();
	}

	public function add(){
		$stmt = self::db()->prepare(
			"insert into ".self::$tablename." 
			 (code, name, lastname, dni, phone, email, address, location_id, category_id, meter_id, status, created_at)
			 values (:code, :name, :lastname, :dni, :phone, :email, :address, :location_id, :category_id, :meter_id, :status, NOW())"
		);
		$stmt->execute([
			'code' => !empty($this->code) ? $this->code : null,
			'name' => $this->name,
			'lastname' => $this->lastname ?? '',
			'dni' => !empty($this->dni) ? $this->dni : null,
			'phone' => !empty($this->phone) ? $this->phone : null,
			'email' => !empty($this->email) ? $this->email : null,
			'address' => !empty($this->address) ? $this->address : null,
			'location_id' => !empty($this->location_id) ? (int)$this->location_id : null,
			'category_id' => !empty($this->category_id) ? (int)$this->category_id : null,
			'meter_id' => !empty($this->meter_id) ? (int)$this->meter_id : null,
			'status' => (int)$this->status,
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
			 set code = :code, name = :name, lastname = :lastname, dni = :dni,
			     phone = :phone, email = :email, address = :address,
			     location_id = :location_id, category_id = :category_id,
			     meter_id = :meter_id, status = :status
			 where id = :id"
		);
		$stmt->execute([
			'code' => !empty($this->code) ? $this->code : null,
			'name' => $this->name,
			'lastname' => $this->lastname ?? '',
			'dni' => !empty($this->dni) ? $this->dni : null,
			'phone' => !empty($this->phone) ? $this->phone : null,
			'email' => !empty($this->email) ? $this->email : null,
			'address' => !empty($this->address) ? $this->address : null,
			'location_id' => !empty($this->location_id) ? (int)$this->location_id : null,
			'category_id' => !empty($this->category_id) ? (int)$this->category_id : null,
			'meter_id' => !empty($this->meter_id) ? (int)$this->meter_id : null,
			'status' => (int)$this->status,
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

	public static function getByMeterId($meterId){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where meter_id = :meter_id");
		$stmt->execute(['meter_id' => $meterId]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		$found = $stmt->fetch();
		return $found ?: null;
	}

	public static function getAll(){
		$stmt = self::db()->query("select * from ".self::$tablename." order by id desc");
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function getAllByLocation($locationId){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where location_id = :loc order by name asc");
		$stmt->execute(['loc' => $locationId]);
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function countAll(): int {
		$stmt = self::db()->query("select count(*) from ".self::$tablename);
		return (int) $stmt->fetchColumn();
	}

	public static function countActive(): int {
		$stmt = self::db()->query("select count(*) from ".self::$tablename." where status = 1");
		return (int) $stmt->fetchColumn();
	}

	public function getLocation(){
		if (!empty($this->location_id)) {
			return LocationData::getById($this->location_id);
		}
		return null;
	}

	public function getCategory(){
		if (!empty($this->category_id)) {
			return CategoryData::getById($this->category_id);
		}
		return null;
	}

	public function getMeter(){
		if (!empty($this->meter_id)) {
			return MeterData::getById($this->meter_id);
		}
		return null;
	}

	public function getFullName(): string {
		return trim($this->name . ' ' . $this->lastname);
	}

	public function getStatusLabel(): string {
		switch ((int)$this->status) {
			case 1: return "Activo";
			case 2: return "Suspendido";
			case 3: return "Cancelado";
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
