<?php

namespace Category\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

class Category
{
	public $id;
	public $name;
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->name = (!empty($data['name'])) ? $data['name'] : null;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}


	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();

			$inputFilter->add([
				'name'     => 'name',
				'required' => true,
				'filters'  => [
					['name' => 'StripTags'],
					['name' => 'StringTrim']
				],
				'validators' => [
					[
						'name'    => 'StringLength',
						'options' => [
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 255
						]
					]
				]
			]);

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}
}
