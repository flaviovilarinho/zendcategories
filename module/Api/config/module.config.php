<?php
return [
	'controllers' => [
		'invokables' => [
			'Api\Controller\Category' => 'Api\Controller\CategoryController'
		]
	],
	'router' => [
		'routes' => [
			'category-rest' => [
				'type' => 'segment',
				'options' => [
					'route' => '/v1/category[/:id]',
					'constraints' => [
						'id' => '[0-9]+'
					],
					'defaults' => [
						'controller' => 'Api\Controller\Category'
					]
				]
			]
		]
	],
	'view_manager' => [
		'strategies' => [
			'ViewJsonStrategy'
		]
	]
];
