<?php
namespace App\Service;

/**
 * Servicio para recopilar estadísticas y métricas del sistema de agua.
 */
class DashboardService {
	public function getMetrics(): array {
		$currentPeriod = date('Y-m');

		$totalClients = \ClientData::countAll();
		$activeClients = \ClientData::countActive();
		$totalMeters = \MeterData::countAll();
		$activeMeters = \MeterData::countByStatus(1);
		$maintenanceMeters = \MeterData::countByStatus(2);

		$monthReadings = \ValData::countByPeriod($currentPeriod);
		$monthConsumption = \ValData::sumConsumptionByPeriod($currentPeriod);
		$totalConsumption = \ValData::sumTotalConsumption();

		$recentReadings = array_slice(\ValData::getAll(), 0, 8);

		return [
			'total_clients' => $totalClients,
			'active_clients' => $activeClients,
			'total_meters' => $totalMeters,
			'active_meters' => $activeMeters,
			'maintenance_meters' => $maintenanceMeters,
			'month_readings' => $monthReadings,
			'month_consumption' => $monthConsumption,
			'total_consumption' => $totalConsumption,
			'recent_readings' => $recentReadings,
			'current_period' => $currentPeriod,
		];
	}
}
