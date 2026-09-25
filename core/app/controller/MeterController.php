<?php
namespace App\Controller;

use App\Service\MeterService;
use ViewEngine;
use Req;

/**
 * Gestiona el inventario de medidores de agua (listar, crear, editar, eliminar).
 */
class MeterController {
	private $meterService;
	private $baseFolder;

	public function __construct() {
		$this->meterService = new MeterService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	public function index() {
		$meters = $this->meterService->getAll();
		ViewEngine::render('meters/index.html.twig', ['meters' => $meters]);
	}

	public function new() {
		ViewEngine::render('meters/new.html.twig');
	}

	public function create() {
		$errors = Req::validate([
			'identifier' => 'required',
			'brand' => 'required',
			'serie' => 'required'
		]);

		// Validar que el identificador no exista ya
		if (empty($errors)) {
			$existing = \MeterData::getByIdentifier(trim(Req::post('identifier', '')));
			if ($existing) {
				$errors['identifier'] = 'Este identificador de medidor ya está registrado.';
			}
		}

		if (!empty($errors)) {
			ViewEngine::render('meters/new.html.twig', ['errors' => $errors, 'old' => Req::post()]);
			return;
		}

		$this->meterService->create(Req::post());
		$_SESSION['success'] = 'Medidor registrado correctamente';
		header('Location: ' . $this->baseFolder . '/meters');
	}

	public function edit($vars) {
		$meter = $this->meterService->getById($vars['id']);
		if (!$meter) {
			header('Location: ' . $this->baseFolder . '/meters');
			return;
		}
		ViewEngine::render('meters/edit.html.twig', ['meter' => $meter]);
	}

	public function update($vars) {
		$errors = Req::validate([
			'identifier' => 'required',
			'brand' => 'required',
			'serie' => 'required'
		]);

		if (!empty($errors)) {
			$meter = $this->meterService->getById($vars['id']);
			ViewEngine::render('meters/edit.html.twig', ['meter' => $meter, 'errors' => $errors]);
			return;
		}

		$this->meterService->update($vars['id'], Req::post());
		$_SESSION['updated'] = 'Medidor actualizado correctamente';
		header('Location: ' . $this->baseFolder . '/meters');
	}

	public function delete($vars) {
		$this->meterService->delete($vars['id']);
		$_SESSION['deleted'] = 'Medidor eliminado correctamente';
		header('Location: ' . $this->baseFolder . '/meters');
	}
}
