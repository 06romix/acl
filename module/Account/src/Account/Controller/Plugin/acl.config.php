<?php
namespace Account\Controller\Plugin;

return [
    'acl' => [
        'roles' => [
            'guest'    => 'null',
            'base'     => 'guest',
            'employee' => 'base',
            'admin'    => 'base',
            'owner'    => 'base',
        ],
        'resources' => [
            'resources' => [
                'Account' => [
                    'Account\Controller\Index',
                    'dashboard',
                    'reports',
                    'configuration',
                ],
            ],
        ],
        'allow' => [
            // Account Controller
            'Account' => [
              'all' => 'base',
            ],
            'Account\Controller\Index' => [
              'all' => 'guest'
            ],
        ],
        'deny' => [
            'reports' => [
              'see' => 'admin'
            ],
            'configuration' => [
              'access' => 'employee'
            ],
        ],
    ]
];