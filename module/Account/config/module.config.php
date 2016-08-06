<?php
// Filename: /module/Account/config/module.config.php
return [

  'controllers' => [
    'invokables' => [
      'Account\Controller\Index' => 'Account\Controller\IndexController',
    ]
  ],

  'router' => [
    'routes' => [

      'account' => [
        'type'    => 'segment',
        'options' => [
          'route'    => '/[:action/][:id/]',
           'constraints' => [
             'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
             'id'     => '[0-9]+',
           ],
          'defaults' => [
            'controller' => 'Account\Controller\Index',
            'action'     => 'index',
          ],
        ],
      ],

    ],
  ],

  'view_manager' => [
    'template_path_stack' => [
      __DIR__ . '/../view',
    ],
  ], 
];