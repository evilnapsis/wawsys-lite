<?php
namespace App\Service;

/**
 * Servicio para la gestión de clientes / abonados del agua.
 */
class ClientService {
	public function getAll(): array {
		return \ClientData::getAll();
	}

	public function getById($id) {
		return \ClientData::getById($id);
	}

	public function create(array $data): \ClientData {
		$client = new \ClientData();
		$client->code = !empty($data['code']) ? trim($data['code']) : null;
		$client->name = trim($data['name'] ?? '');
		$client->lastname = trim($data['lastname'] ?? '');
		$client->dni = !empty($data['dni']) ? trim($data['dni']) : null;
		$client->phone = !empty($data['phone']) ? trim($data['phone']) : null;
		$client->email = !empty($data['email']) ? trim($data['email']) : null;
		$client->address = !empty($data['address']) ? trim($data['address']) : null;
		$client->location_id = !empty($data['location_id']) ? (int)$data['location_id'] : null;
		$client->category_id = !empty($data['category_id']) ? (int)$data['category_id'] : null;
		$client->meter_id = !empty($data['meter_id']) ? (int)$data['meter_id'] : null;
		$client->status = isset($data['status']) ? (int)$data['status'] : 1;
		$client->add();
		return $client;
	}

	public function update($id, array $data): void {
		$client = \ClientData::getById($id);
		if (!$client) return;

		$client->code = !empty($data['code']) ? trim($data['code']) : null;
		$client->name = trim($data['name'] ?? $client->name);
		$client->lastname = trim($data['lastname'] ?? $client->lastname);
		$client->dni = !empty($data['dni']) ? trim($data['dni']) : null;
		$client->phone = !empty($data['phone']) ? trim($data['phone']) : null;
		$client->email = !empty($data['email']) ? trim($data['email']) : null;
		$client->address = !empty($data['address']) ? trim($data['address']) : null;
		$client->location_id = !empty($data['location_id']) ? (int)$data['location_id'] : null;
		$client->category_id = !empty($data['category_id']) ? (int)$data['category_id'] : null;
		$client->meter_id = !empty($data['meter_id']) ? (int)$data['meter_id'] : null;
		if (isset($data['status'])) {
			$client->status = (int)$data['status'];
		}
		$client->update();
	}

	public function delete($id): void {
		$client = \ClientData::getById($id);
		if (!$client) return;
		$client->del();
	}
}
