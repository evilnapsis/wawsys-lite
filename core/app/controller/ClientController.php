<?php
namespace App\Controller;

use App\Service\ClientService;
use App\Service\LocationService;
use App\Service\CategoryService;
use App\Service\MeterService;
use ViewEngine;
use Req;

/**
 * Administra el registro y ficha de clientes/abonados del agua.
 */
class ClientController {
	private $clientService;
	private $locationService;
	private $categoryService;
	private $meterService;
	private $baseFolder;

	public function __construct() {
		$this->clientService = new ClientService();
		$this->locationService = new LocationService();
		$this->categoryService = new CategoryService();
		$this->meterService = new MeterService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	public function index() {
		$clients = $this->clientService->getAll();
		ViewEngine::render('clients/index.html.twig', [
			'clients' => $clients,
		]);
	}

	public function new() {
		ViewEngine::render('clients/new.html.twig', [
			'locations' => $this->locationService->getAll(),
			'categories' => $this->categoryService->getAllCategories(),
			'meters' => $this->meterService->getAvailableForClient(),
		]);
	}

	public function create() {
		$errors = Req::validate(['name' => 'required']);
		if (!empty($errors)) {
			ViewEngine::render('clients/new.html.twig', [
				'errors' => $errors,
				'old' => Req::post(),
				'locations' => $this->locationService->getAll(),
				'categories' => $this->categoryService->getAllCategories(),
				'meters' => $this->meterService->getAvailableForClient(),
			]);
			return;
		}

		$this->clientService->create(Req::post());
		$_SESSION['success'] = 'Cliente registrado correctamente';
		header('Location: ' . $this->baseFolder . '/clients');
	}

	public function show($vars) {
		$client = $this->clientService->getById($vars['id']);
		if (!$client) {
			header('Location: ' . $this->baseFolder . '/clients');
			return;
		}
		$readings = \ValData::getAllByClient($vars['id']);
		ViewEngine::render('clients/show.html.twig', [
			'client' => $client,
			'readings' => $readings,
		]);
	}

	public function edit($vars) {
		$client = $this->clientService->getById($vars['id']);
		if (!$client) {
			header('Location: ' . $this->baseFolder . '/clients');
			return;
		}
		ViewEngine::render('clients/edit.html.twig', [
			'client' => $client,
			'locations' => $this->locationService->getAll(),
			'categories' => $this->categoryService->getAllCategories(),
			'meters' => $this->meterService->getAvailableForClient($client->id),
		]);
	}

	public function update($vars) {
		$errors = Req::validate(['name' => 'required']);
		if (!empty($errors)) {
			$client = $this->clientService->getById($vars['id']);
			ViewEngine::render('clients/edit.html.twig', [
				'client' => $client,
				'errors' => $errors,
				'locations' => $this->locationService->getAll(),
				'categories' => $this->categoryService->getAllCategories(),
				'meters' => $this->meterService->getAvailableForClient($client->id),
			]);
			return;
		}

		$this->clientService->update($vars['id'], Req::post());
		$_SESSION['updated'] = 'Cliente actualizado correctamente';
		header('Location: ' . $this->baseFolder . '/clients');
	}

	public function delete($vars) {
		$this->clientService->delete($vars['id']);
		$_SESSION['deleted'] = 'Cliente eliminado correctamente';
		header('Location: ' . $this->baseFolder . '/clients');
	}
}
