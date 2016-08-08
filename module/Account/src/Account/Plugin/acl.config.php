<?php
namespace Account\Plugin;

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
                'Auth' => [
                  'Auth\Controller\Auth',
                  'login',
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
              'registration' => [
                'all' => 'guest',
              ],
              'referral' => [
                'all' => 'owner',
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