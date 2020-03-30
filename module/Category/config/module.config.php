<?php
return [
	'controllers' => [
		'invokables' => [
			'Category\Controller\Category' => 'Category\Controller\CategoryController'
		]
	],
	'router' => [
		'routes' => [
			'category' => [
				'type'    => 'segment',
				'options' => [
					'route'    => '/category[/:action][/:id]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+'
					],
					'defaults' => [
						'controller' => 'Category\Controller\Category',
						'action'     => 'index'
					]
				]
			]
		]
	],
	'view_manager' => [
		'template_path_stack' => [
			'category' => __DIR__ . '/../view',
		]
	]
];
