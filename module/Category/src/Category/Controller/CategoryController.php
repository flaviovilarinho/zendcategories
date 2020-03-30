<?php

namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Category\Model\Category;
use Category\Form\CategoryForm;

class CategoryController extends AbstractActionController
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

	public function indexAction()
	{
		return new ViewModel([
			'categories' => $this->getCategoryTable()->fetchAll(),
		]);
	}

	public function addAction()
	{
		$form = new CategoryForm();
		$form->get('submit')->setValue('Add');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$category = new Category;
			$form->setInputFilter($category->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$category->exchangeArray($form->getData());
				$this->getCategoryTable()->saveCategory($category);

				// Redirect to list of categories
				return $this->redirect()->toRoute('category');
			}
		}
		return ['form' => $form];
	}

	public function editAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('category', [
				'action' => 'add'
			]);
		}

		try {
			$category = $this->getCategoryTable()->getCategory($id);
		} catch (\Exception $ex) {
			return $this->redirect()->toRoute('category', array(
				'action' => 'index'
			));
		}

		$form = new CategoryForm();
		$form->bind($category);
		$form->get('submit')->setAttribute('value', 'Edit');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($category->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$this->getCategoryTable()->saveCategory($category);

				// Redirect to list of categories
				return $this->redirect()->toRoute('category');
			}
		}

		return [
			'id' => $id,
			'form' => $form
		];
	}

	public function deleteAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('category');
		}

		$request = $this->getRequest();
		if ($request->isPost()) {
			$del = $request->getPost('del', 'No');

			if ($del == 'Yes') {
				$id = (int) $request->getPost('id');
				$this->getCategoryTable()->deleteCategory($id);
			}

			// Redirect to list of categories
			return $this->redirect()->toRoute('category');
		}

		return [
			'id' => $id,
			'category' => $this->getCategoryTable()->getCategory($id)
		];
	}
}
