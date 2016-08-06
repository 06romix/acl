<?php
namespace Account\Acl;

return [
    'acl' => [
        'roles' => [
            'base'     => 'null',
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
            'dashboard' => [
              'all' => 'base'
            ],
            'reports' => [
              'all' => 'base'
            ],
            'configuration' => [
              'all' => 'admin'
            ],
        ],
        'deny' => [
            'reports' => [
              'all' => 'admin'
            ],
            'configuration' => [
              'all' => 'employee'
            ],
        ],
    ]
];