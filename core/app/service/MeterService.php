<?php
namespace App\Service;

/**
 * Servicio para la gestión de medidores de agua y su ciclo de vida.
 */
class MeterService {
	public function getAll(): array {
		return \MeterData::getAll();
	}

	public function getById($id) {
		return \MeterData::getById($id);
	}

	public function getAvailableForClient($clientId = null): array {
		return \MeterData::getAvailableForClient($clientId);
	}

	public function create(array $data): void {
		$meter = new \MeterData();
		$meter->identifier = trim($data['identifier'] ?? '');
		$meter->brand = trim($data['brand'] ?? '');
		$meter->serie = trim($data['serie'] ?? '');
		$meter->issued_at = !empty($data['issued_at']) ? $data['issued_at'] : null;
		$meter->expired_at = !empty($data['expired_at']) ? $data['expired_at'] : null;
		$meter->status = isset($data['status']) ? (int)$data['status'] : 1;
		$meter->add();
	}

	public function update($id, array $data): void {
		$meter = \MeterData::getById($id);
		if (!$meter) return;
		$meter->identifier = trim($data['identifier'] ?? $meter->identifier);
		$meter->brand = trim($data['brand'] ?? $meter->brand);
		$meter->serie = trim($data['serie'] ?? $meter->serie);
		$meter->issued_at = !empty($data['issued_at']) ? $data['issued_at'] : null;
		$meter->expired_at = !empty($data['expired_at']) ? $data['expired_at'] : null;
		if (isset($data['status'])) {
			$meter->status = (int)$data['status'];
		}
		$meter->update();
	}

	public function delete($id): void {
		$meter = \MeterData::getById($id);
		if (!$meter) return;
		$meter->del();
	}
}
