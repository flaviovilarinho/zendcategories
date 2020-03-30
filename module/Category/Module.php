<?php

namespace Category;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Category\Model\Category;
use Category\Model\CategoryTable;

class Module
{
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				]
			]
		];
	}

	public function getServiceConfig()
	{
		return [
			'factories' => [
				'Category\Model\CategoryTable' =>  function ($sm) {
					$tableGateway = $sm->get('CategoryTableGateway');
					$table = new CategoryTable($tableGateway);
					return $table;
				},
				'CategoryTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Category());
					return new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
				}
			]
		];
	}
}
