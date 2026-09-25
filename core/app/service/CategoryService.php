<?php
namespace App\Service;

/**
 * Servicio para la gestión de categorías de consumo de agua.
 */
class CategoryService {
	public function getAllCategories(): array {
		return \CategoryData::getAll();
	}

	public function getCategoryById($id) {
		return \CategoryData::getById($id);
	}

	public function createCategory(array $data): void {
		$category = new \CategoryData();
		$category->name = trim($data['name'] ?? '');
		$category->description = trim($data['description'] ?? '');
		$category->add();
	}

	public function updateCategory($id, array $data): void {
		$category = \CategoryData::getById($id);
		if (!$category) return;
		$category->name = trim($data['name'] ?? $category->name);
		$category->description = trim($data['description'] ?? $category->description);
		$category->update();
	}

	public function deleteCategory($id): void {
		$category = \CategoryData::getById($id);
		if (!$category) return;
		$category->del();
	}
}
