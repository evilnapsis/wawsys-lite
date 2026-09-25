<?php
namespace App\Controller;

use App\Service\LocationService;
use ViewEngine;
use Req;

/**
 * Gestiona el catálogo de ubicaciones y sectores (listar, crear, editar, eliminar).
 */
class LocationController {
	private $locationService;
	private $baseFolder;

	public function __construct() {
		$this->locationService = new LocationService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	public function index() {
		$locations = $this->locationService->getAll();
		ViewEngine::render('locations/index.html.twig', ['locations' => $locations]);
	}

	public function new() {
		ViewEngine::render('locations/new.html.twig');
	}

	public function create() {
		$errors = Req::validate(['name' => 'required']);
		if (!empty($errors)) {
			ViewEngine::render('locations/new.html.twig', ['errors' => $errors, 'old' => Req::post()]);
			return;
		}

		$this->locationService->create(Req::post());
		$_SESSION['success'] = 'Ubicación agregada correctamente';
		header('Location: ' . $this->baseFolder . '/locations');
	}

	public function edit($vars) {
		$location = $this->locationService->getById($vars['id']);
		if (!$location) {
			header('Location: ' . $this->baseFolder . '/locations');
			return;
		}
		ViewEngine::render('locations/edit.html.twig', ['location' => $location]);
	}

	public function update($vars) {
		$errors = Req::validate(['name' => 'required']);
		if (!empty($errors)) {
			$location = $this->locationService->getById($vars['id']);
			ViewEngine::render('locations/edit.html.twig', ['location' => $location, 'errors' => $errors]);
			return;
		}

		$this->locationService->update($vars['id'], Req::post());
		$_SESSION['updated'] = 'Ubicación actualizada correctamente';
		header('Location: ' . $this->baseFolder . '/locations');
	}

	public function delete($vars) {
		$this->locationService->delete($vars['id']);
		$_SESSION['deleted'] = 'Ubicación eliminada correctamente';
		header('Location: ' . $this->baseFolder . '/locations');
	}
}
