<?php
/**
 * Modelo para las lecturas de consumo de agua (tabla 'val').
 */
class ValData {
	public static $tablename = "val";
	public $id;
	public $client_id;
	public $meter_id;
	public $val;
	public $previous_val;
	public $consumption;
	public $image;
	public $date_at;
	public $period;
	public $comment;
	public $user_id;
	public $created_at;

	public function __construct(){
		$this->client_id = null;
		$this->meter_id = null;
		$this->val = 0.00;
		$this->previous_val = 0.00;
		$this->consumption = 0.00;
		$this->image = null;
		$this->date_at = date('Y-m-d');
		$this->period = date('Y-m');
		$this->comment = null;
		$this->user_id = null;
		$this->created_at = "NOW()";
	}

	private static function db(): \PDO {
		return Database::getPdo();
	}

	public function add(){
		$stmt = self::db()->prepare(
			"insert into ".self::$tablename."
			 (client_id, meter_id, val, previous_val, consumption, image, date_at, period, comment, user_id, created_at)
			 values (:client_id, :meter_id, :val, :previous_val, :consumption, :image, :date_at, :period, :comment, :user_id, NOW())"
		);
		$stmt->execute([
			'client_id' => (int)$this->client_id,
			'meter_id' => (int)$this->meter_id,
			'val' => (float)$this->val,
			'previous_val' => (float)$this->previous_val,
			'consumption' => (float)$this->consumption,
			'image' => !empty($this->image) ? $this->image : null,
			'date_at' => $this->date_at,
			'period' => !empty($this->period) ? $this->period : date('Y-m'),
			'comment' => !empty($this->comment) ? $this->comment : null,
			'user_id' => (int)$this->user_id,
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

	public static function getById($id){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where id = :id");
		$stmt->execute(['id' => $id]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		$found = $stmt->fetch();
		return $found ?: null;
	}

	public static function getAll(){
		$stmt = self::db()->query("select * from ".self::$tablename." order by date_at desc, id desc");
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	public static function getAllByClient($clientId){
		$stmt = self::db()->prepare("select * from ".self::$tablename." where client_id = :cid order by date_at desc, id desc");
		$stmt->execute(['cid' => $clientId]);
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	/**
	 * Retorna la última lectura registrada para un cliente.
	 */
	public static function getLastByClient($clientId){
		$stmt = self::db()->prepare(
			"select * from ".self::$tablename." 
			 where client_id = :cid 
			 order by date_at desc, id desc 
			 limit 1"
		);
		$stmt->execute(['cid' => $clientId]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		$found = $stmt->fetch();
		return $found ?: null;
	}

	public static function countAll(): int {
		$stmt = self::db()->query("select count(*) from ".self::$tablename);
		return (int) $stmt->fetchColumn();
	}

	public static function countByPeriod(string $period): int {
		$stmt = self::db()->prepare("select count(*) from ".self::$tablename." where period = :period");
		$stmt->execute(['period' => $period]);
		return (int) $stmt->fetchColumn();
	}

	public static function sumConsumptionByPeriod(string $period): float {
		$stmt = self::db()->prepare("select coalesce(sum(consumption), 0) from ".self::$tablename." where period = :period");
		$stmt->execute(['period' => $period]);
		return (float) $stmt->fetchColumn();
	}

	public static function sumTotalConsumption(): float {
		$stmt = self::db()->query("select coalesce(sum(consumption), 0) from ".self::$tablename);
		return (float) $stmt->fetchColumn();
	}

	public function getClient(){
		if (!empty($this->client_id)) {
			return ClientData::getById($this->client_id);
		}
		return null;
	}

	public function getMeter(){
		if (!empty($this->meter_id)) {
			return MeterData::getById($this->meter_id);
		}
		return null;
	}

	public function getUser(){
		if (!empty($this->user_id)) {
			return UserData::getById($this->user_id);
		}
		return null;
	}
}
?>
