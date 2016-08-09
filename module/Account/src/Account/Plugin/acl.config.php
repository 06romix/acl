<?php
namespace Account\Plugin;

return [
    'acl' => [
        'roles' => [
            'guest'    => 'null',
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
                'Auth' => [
                  'Auth\Controller\Auth',
                  'login',
                  'logout',
                  'registration',
                  'referral',
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
            // Authorization Controller
              'login' => [
                'all' => 'guest',
              ],
              'logout' => [
                'all' => 'base',
              ],
              'registration' => [
                'all' => 'guest',
              ],
              'referral' => [
                'all' => 'owner',
              ],
        ],
        'deny' => [
            // Account Controller
            'reports' => [
              'see' => 'admin'
            ],
            'configuration' => [
              'access' => 'employee'
            ],
        ],
    ]
];