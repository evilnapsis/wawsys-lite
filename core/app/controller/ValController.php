<?php
namespace App\Controller;

use App\Service\ValService;
use App\Service\ClientService;
use ViewEngine;
use Req;

/**
 * Controla el registro y visualización de lecturas de consumo de agua.
 */
class ValController {
	private $valService;
	private $clientService;
	private $baseFolder;

	public function __construct() {
		$this->valService = new ValService();
		$this->clientService = new ClientService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	public function index() {
		$readings = $this->valService->getAll();
		ViewEngine::render('vals/index.html.twig', [
			'readings' => $readings,
		]);
	}

	public function new() {
		$selectedClientId = Req::get('client_id');
		$clients = $this->clientService->getAll();

		$lastReading = null;
		$selectedClient = null;
		if ($selectedClientId) {
			$selectedClient = $this->clientService->getById($selectedClientId);
			$lastReading = $this->valService->getLastByClient($selectedClientId);
		}

		ViewEngine::render('vals/new.html.twig', [
			'clients' => $clients,
			'selected_client_id' => $selectedClientId,
			'selected_client' => $selectedClient,
			'last_reading' => $lastReading,
		]);
	}

	public function lastReadingAjax() {
		header('Content-Type: application/json');
		$clientId = (int)Req::get('client_id', 0);
		$last = $this->valService->getLastByClient($clientId);
		$client = $this->clientService->getById($clientId);

		$meter = $client ? $client->getMeter() : null;

		echo json_encode([
			'success' => true,
			'previous_val' => $last ? (float)$last->val : 0.00,
			'last_date' => $last ? $last->date_at : null,
			'meter_id' => $meter ? $meter->id : null,
			'meter_identifier' => $meter ? $meter->identifier : 'Sin medidor asignado',
			'meter_brand' => $meter ? $meter->brand : '',
			'meter_serie' => $meter ? $meter->serie : '',
		]);
		exit;
	}

	public function create() {
		$errors = Req::validate([
			'client_id' => 'required',
			'val' => 'required',
			'date_at' => 'required',
		]);

		$clientId = (int)Req::post('client_id');
		$client = $this->clientService->getById($clientId);
		if (!$client || empty($client->meter_id)) {
			$errors['client_id'] = 'El cliente seleccionado no tiene un medidor asignado.';
		}

		if (!empty($errors)) {
			ViewEngine::render('vals/new.html.twig', [
				'errors' => $errors,
				'old' => Req::post(),
				'clients' => $this->clientService->getAll(),
				'selected_client_id' => $clientId,
			]);
			return;
		}

		try {
			$userId = $_SESSION['user_id'] ?? 1;
			$file = $_FILES['image'] ?? null;
			$this->valService->recordReading(Req::post(), $file, $userId);
			$_SESSION['success'] = 'Lectura registrada correctamente';
			header('Location: ' . $this->baseFolder . '/vals');
		} catch (\Exception $e) {
			ViewEngine::render('vals/new.html.twig', [
				'errors' => ['general' => $e->getMessage()],
				'old' => Req::post(),
				'clients' => $this->clientService->getAll(),
				'selected_client_id' => $clientId,
			]);
		}
	}

	public function show($vars) {
		$reading = $this->valService->getById($vars['id']);
		if (!$reading) {
			header('Location: ' . $this->baseFolder . '/vals');
			return;
		}
		ViewEngine::render('vals/show.html.twig', [
			'reading' => $reading,
		]);
	}

	public function delete($vars) {
		$this->valService->delete($vars['id']);
		$_SESSION['deleted'] = 'Lectura eliminada correctamente';
		header('Location: ' . $this->baseFolder . '/vals');
	}
}
