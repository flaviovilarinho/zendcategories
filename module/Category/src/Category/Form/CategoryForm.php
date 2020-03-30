<?php

namespace Category\Form;

use Zend\Form\Form;

class CategoryForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('category');

		$this->add([
			'name' => 'id',
			'type' => 'Hidden'
		]);

		$this->add([
			'name' => 'name',
			'type' => 'Text',
			'options' => [
				'label' => 'Name',
			],
			'attributes' => [
				'class' => 'form-control'
			]
		]);

		$this->add([
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => [
				'value' => 'Go',
				'id' => 'submitbutton',
				'class' => 'btn btn-success'
			]
		]);
	}
}
