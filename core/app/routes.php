<?php
use App\Controller\HomeController;
use App\Controller\ValController;
use App\Controller\ClientController;
use App\Controller\MeterController;
use App\Controller\LocationController;
use App\Controller\CategoryController;
use App\Controller\UserController;
use App\Controller\SettingsController;
use App\Controller\ProfileController;
use App\Controller\AuthController;

return function(FastRoute\RouteCollector $r) {
	// Inicio / Dashboard
	$r->addRoute('GET', '/', [HomeController::class, 'index']);
	$r->addRoute('GET', '/home', [HomeController::class, 'index']);

	// Autenticación
	$r->addRoute('GET', '/login', [AuthController::class, 'showLogin']);
	$r->addRoute('POST', '/login', [AuthController::class, 'processLogin']);
	$r->addRoute('GET', '/logout', [AuthController::class, 'logout']);

	// Lecturas de consumo de agua (val)
	$r->addRoute('GET', '/vals', [ValController::class, 'index']);
	$r->addRoute('GET', '/val/new', [ValController::class, 'new']);
	$r->addRoute('POST', '/val/create', [ValController::class, 'create']);
	$r->addRoute('GET', '/val/last-reading', [ValController::class, 'lastReadingAjax']);
	$r->addRoute('GET', '/val/{id:\d+}', [ValController::class, 'show']);
	$r->addRoute('POST', '/val/{id:\d+}/delete', [ValController::class, 'delete']);

	// Clientes / Abonados
	$r->addRoute('GET', '/clients', [ClientController::class, 'index']);
	$r->addRoute('GET', '/client/new', [ClientController::class, 'new']);
	$r->addRoute('POST', '/client/create', [ClientController::class, 'create']);
	$r->addRoute('GET', '/client/{id:\d+}', [ClientController::class, 'show']);
	$r->addRoute('GET', '/client/{id:\d+}/edit', [ClientController::class, 'edit']);
	$r->addRoute('POST', '/client/{id:\d+}/update', [ClientController::class, 'update']);
	$r->addRoute('POST', '/client/{id:\d+}/delete', [ClientController::class, 'delete']);

	// Medidores
	$r->addRoute('GET', '/meters', [MeterController::class, 'index']);
	$r->addRoute('GET', '/meter/new', [MeterController::class, 'new']);
	$r->addRoute('POST', '/meter/create', [MeterController::class, 'create']);
	$r->addRoute('GET', '/meter/{id:\d+}/edit', [MeterController::class, 'edit']);
	$r->addRoute('POST', '/meter/{id:\d+}/update', [MeterController::class, 'update']);
	$r->addRoute('POST', '/meter/{id:\d+}/delete', [MeterController::class, 'delete']);

	// Ubicaciones / Sectores
	$r->addRoute('GET', '/locations', [LocationController::class, 'index']);
	$r->addRoute('GET', '/location/new', [LocationController::class, 'new']);
	$r->addRoute('POST', '/location/create', [LocationController::class, 'create']);
	$r->addRoute('GET', '/location/{id:\d+}/edit', [LocationController::class, 'edit']);
	$r->addRoute('POST', '/location/{id:\d+}/update', [LocationController::class, 'update']);
	$r->addRoute('POST', '/location/{id:\d+}/delete', [LocationController::class, 'delete']);

	// Categorías de consumo
	$r->addRoute('GET', '/categories', [CategoryController::class, 'index']);
	$r->addRoute('GET', '/category/new', [CategoryController::class, 'new']);
	$r->addRoute('POST', '/category/create', [CategoryController::class, 'create']);
	$r->addRoute('GET', '/category/{id:\d+}/edit', [CategoryController::class, 'edit']);
	$r->addRoute('POST', '/category/{id:\d+}/update', [CategoryController::class, 'update']);
	$r->addRoute('POST', '/category/{id:\d+}/delete', [CategoryController::class, 'delete']);

	// Usuarios
	$r->addRoute('GET', '/users', [UserController::class, 'index']);
	$r->addRoute('GET', '/user/new', [UserController::class, 'new']);
	$r->addRoute('POST', '/user/create', [UserController::class, 'create']);
	$r->addRoute('GET', '/user/{id:\d+}/edit', [UserController::class, 'edit']);
	$r->addRoute('POST', '/user/{id:\d+}/update', [UserController::class, 'update']);
	$r->addRoute('POST', '/user/{id:\d+}/delete', [UserController::class, 'delete']);

	// Perfil y Ajustes
	$r->addRoute('GET', '/profile', [ProfileController::class, 'index']);
	$r->addRoute('POST', '/profile/change-password', [ProfileController::class, 'changePassword']);
	$r->addRoute('GET', '/settings', [SettingsController::class, 'index']);
	$r->addRoute('POST', '/settings/update', [SettingsController::class, 'update']);
};
