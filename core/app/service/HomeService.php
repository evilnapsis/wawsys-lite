<?php
namespace App\Service;

/**
 * Prepara las métricas y datos para el Dashboard de WawSys.
 */
class HomeService {
	public function getDashboardData(): array {
		$dashboardService = new DashboardService();
		return $dashboardService->getMetrics();
	}
}
