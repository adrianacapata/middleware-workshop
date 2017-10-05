<?php

use Apidemia\Blog\Service\PostServiceInterface;
use Apidemia\Blog\Service\PostService;
use Apidemia\Blog\Factory\PostFactory;
use Apidemia\Blog\Controller\PostFrontendController;
use Dot\Rbac\Guard\Guard\GuardInterface;

return [
    'dependencies' => [
        'invokables' => [
           PostServiceInterface::class => PostService::class
        ],
        'factories' => [
            PostFrontendController::class => PostFactory::class
        ]
    ],

    'dot_authorization' => [
    'protection_policy' => GuardInterface::POLICY_ALLOW,

    'event_listeners' => [],

    'guards_provider_manager' => [],
    'guard_manager' => [],

    'guards_provider' => [
        'type' => 'ArrayGuards',
        'options' => [
            'guards' => [
                [
                    'type' => 'ControllerPermission',
                    'options' => [
                        'rules' => [
                            [
                                'route' => 'blog',
                                'actions' => [],
                                'permissions' => ['authenticated']
                            ],

                        ]
                    ]
                ]
            ]
        ]
    ],
    ]
];
