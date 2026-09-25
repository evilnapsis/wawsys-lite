<?php
namespace App\Service;

/**
 * Servicio para la gestión de ubicaciones y sectores.
 */
class LocationService {
	public function getAll(): array {
		return \LocationData::getAll();
	}

	public function getById($id) {
		return \LocationData::getById($id);
	}

	public function create(array $data): void {
		$loc = new \LocationData();
		$loc->name = trim($data['name'] ?? '');
		$loc->description = trim($data['description'] ?? '');
		$loc->add();
	}

	public function update($id, array $data): void {
		$loc = \LocationData::getById($id);
		if (!$loc) return;
		$loc->name = trim($data['name'] ?? $loc->name);
		$loc->description = trim($data['description'] ?? $loc->description);
		$loc->update();
	}

	public function delete($id): void {
		$loc = \LocationData::getById($id);
		if (!$loc) return;
		$loc->del();
	}
}
