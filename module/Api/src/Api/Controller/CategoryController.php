<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Category\Model\Category;
use Category\Form\CategoryForm;

class CategoryController extends AbstractRestfulController
{
	protected $categoryTable;

	public function getCategoryTable()
	{
		if (!$this->categoryTable) {
			$sm = $this->getServiceLocator();
			$this->categoryTable = $sm->get('Category\Model\CategoryTable');
		}
		return $this->categoryTable;
	}

	public function getList()
	{
		$categories = $this->getCategoryTable()->fetchAll();

		$data = [];
		foreach ($categories as $category) {
			$data[] = $category;
		}

		return new JsonModel($data);
	}

	public function get($id)
	{
		$category = $this->getCategoryTable()->getCategory($id);

		$data = [
			'id' => $category->id,
			'name' => $category->name
		];

		return new JsonModel($data);
	}

	public function create($data)
	{
		$form = new CategoryForm;
		$category = new Category;

		$data['id'] = 0;
		$form->setInputFilter($category->getInputFilter());
		$form->setData($data);

		if ($form->isValid()) {
			$category->exchangeArray($form->getData());
			$id = $this->getCategoryTable()->saveCategory($category);
		}

		return new JsonModel(['data' => $id]);
	}

	public function update($id, $data)
	{
		$form = new CategoryForm;
		$category = $this->getCategoryTable()->getCategory($id);

		$data['id'] = $id;
		$form->bind($category);
		$form->setInputFilter($category->getInputFilter());
		$form->setData($data);

		if ($form->isValid()) {
			$id = $this->getCategoryTable()->saveCategory($form->getData());
		}

		return new JsonModel(['data' => $id]);
	}

	public function delete($id)
	{
		$this->getCategoryTable()->deleteCategory($id);

		return new JsonModel(['data' => 'deleted']);
	}
}
