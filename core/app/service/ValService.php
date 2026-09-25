<?php
namespace App\Service;

/**
 * Servicio para el registro y cálculo de lecturas y consumos de agua.
 */
class ValService {
	public function getAll(): array {
		return \ValData::getAll();
	}

	public function getById($id) {
		return \ValData::getById($id);
	}

	public function getByClient($clientId): array {
		return \ValData::getAllByClient($clientId);
	}

	public function getLastByClient($clientId) {
		return \ValData::getLastByClient($clientId);
	}

	public function recordReading(array $data, ?array $file = null, int $userId = 1): \ValData {
		$clientId = (int)($data['client_id'] ?? 0);
		$client = \ClientData::getById($clientId);
		if (!$client) {
			throw new \InvalidArgumentException("El cliente especificado no existe.");
		}

		$meterId = !empty($data['meter_id']) ? (int)$data['meter_id'] : $client->meter_id;
		if (empty($meterId)) {
			throw new \InvalidArgumentException("El cliente no tiene un medidor asignado para registrar la lectura.");
		}

		$valNum = (float)($data['val'] ?? 0);

		// Obtener lectura anterior
		$lastReading = \ValData::getLastByClient($clientId);
		$previousVal = $lastReading ? (float)$lastReading->val : 0.00;

		// Si el usuario especificó manualmente una lectura previa
		if (isset($data['previous_val']) && is_numeric($data['previous_val'])) {
			$previousVal = (float)$data['previous_val'];
		}

		// Cálculo de consumo neto
		$consumption = $valNum >= $previousVal ? ($valNum - $previousVal) : $valNum;

		// Procesar foto de evidencia si existe
		$imagePath = null;
		if ($file && isset($file['tmp_name']) && is_uploaded_file($file['tmp_name'])) {
			$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			$allowed = ['jpg', 'jpeg', 'png', 'webp'];
			if (in_array($ext, $allowed)) {
				$uploadDir = dirname(__DIR__, 2) . '/assets/img/readings/';
				if (!is_dir($uploadDir)) {
					mkdir($uploadDir, 0777, true);
				}
				$filename = 'val_' . $clientId . '_' . time() . '.' . $ext;
				if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
					$imagePath = 'assets/img/readings/' . $filename;
				}
			}
		}

		$reading = new \ValData();
		$reading->client_id = $clientId;
		$reading->meter_id = $meterId;
		$reading->val = $valNum;
		$reading->previous_val = $previousVal;
		$reading->consumption = $consumption;
		$reading->image = $imagePath;
		$reading->date_at = !empty($data['date_at']) ? $data['date_at'] : date('Y-m-d');
		$reading->period = !empty($data['period']) ? trim($data['period']) : date('Y-m');
		$reading->comment = !empty($data['comment']) ? trim($data['comment']) : null;
		$reading->user_id = $userId;
		$reading->add();

		return $reading;
	}

	public function delete($id): void {
		$val = \ValData::getById($id);
		if (!$val) return;
		$val->del();
	}
}
