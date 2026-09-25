<?php
/**
 * Modelo de usuarios del sistema.
 * Status: 1. Activo, 2. Inactivo, 3. Suspendido
 * Kind: 1. Administrador, 2. Operador / Lector
 */
class UserData {
	public static $tablename = "user";
	public $id;
	public $name;
	public $lastname;
	public $username;
	public $email;
	public $password;
	public $image;
	public $status;
	public $kind;
	public $created_at;

	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->image = "";
		$this->password = "";
		$this->status = 1;
		$this->kind = 1;
		$this->created_at = "NOW()";
	}

	public function __get($name){
		if ($name === 'is_active') {
			return (int)$this->status === 1;
		}
		if ($name === 'is_admin') {
			return (int)$this->kind === 1;
		}
		return null;
	}

	public function __set($name, $value){
		if ($name === 'is_active') {
			$this->status = !empty($value) ? 1 : 2;
		} elseif ($name === 'is_admin') {
			$this->kind = !empty($value) ? 1 : 2;
		}
	}

	public function __isset($name){
		return in_array($name, ['is_active', 'is_admin']);
	}

	private static function db(): \PDO {
		return Database::getPdo();
	}

	public function add(){
		$status = isset($this->status) ? (int)$this->status : 1;
		$kind = isset($this->kind) ? (int)$this->kind : 1;

		$stmt = self::db()->prepare(
			"insert into ".self::$tablename." (name, lastname, username, email, password, image, status, kind, created_at)
			 values (:name, :lastname, :username, :email, :password, :image, :status, :kind, NOW())"
		);
		$stmt->execute([
			'name' => $this->name,
			'lastname' => $this->lastname ?? '',
			'username' => $this->username,
			'email' => !empty($this->email) ? $this->email : null,
			'password' => $this->password,
			'image' => !empty($this->image) ? $this->image : null,
			'status' => $status,
			'kind' => $kind,
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
		$status = isset($this->status) ? (int)$this->status : 1;
		$kind = isset($this->kind) ? (int)$this->kind : 1;

		$stmt = self::db()->prepare(
			"update ".self::$tablename." 
			 set name = :name, lastname = :lastname, username = :username,
			     email = :email, status = :status, kind = :kind, image = :image
			 where id = :id"
		);
		$stmt->execute([
			'name' => $this->name,
			'lastname' => $this->lastname ?? '',
			'username' => $this->username,
			'email' => !empty($this->email) ? $this->email : null,
			'status' => $status,
			'kind' => $kind,
			'image' => !empty($this->image) ? $this->image : null,
			'id' => $this->id,
		]);
	}

	public function update_passwd(){
		$stmt = self::db()->prepare("update ".self::$tablename." set password = :password where id = :id");
		$stmt->execute(['password' => $this->password, 'id' => $this->id]);
	}

	public static function getById($id){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where id = :id");
		$stmt->execute(['id' => $id]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		return $stmt->fetch() ?: null;
	}

	public static function getByUsername($username){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where username = :u");
		$stmt->execute(['u' => $username]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		return $stmt->fetch() ?: null;
	}

	public static function getByMail($mail){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where email = :email");
		$stmt->execute(['email' => $mail]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		return $stmt->fetch() ?: null;
	}

	public static function getAll(){
		$stmt = self::db()->query("select * from ".self::$tablename." order by id desc");
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function countAll(): int {
		$stmt = self::db()->query("select count(*) from ".self::$tablename);
		return (int) $stmt->fetchColumn();
	}

	public function getKindLabel(): string {
		switch ((int)$this->kind) {
			case 1: return "Administrador";
			case 2: return "Operador / Lector";
			default: return "Otro";
		}
	}

	public function getStatusLabel(): string {
		switch ((int)$this->status) {
			case 1: return "Activo";
			case 2: return "Inactivo";
			case 3: return "Suspendido";
			default: return "Desconocido";
		}
	}

	public function getStatusBadge(): string {
		switch ((int)$this->status) {
			case 1: return "success";
			case 2: return "secondary";
			case 3: return "danger";
			default: return "secondary";
		}
	}
}
?>
