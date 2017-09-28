<?php

use Workshop\Middleware\Service\MultilanguageServiceInterface;
use Workshop\Middleware\Service\MultilanguageStaticService;
use Workshop\Middleware\Service\MultilanguageService;
use Workshop\Middleware\DbMultilanguageMiddleware;
use Workshop\Middleware\DbMultilanguageMiddlewareFactory;

return [
    'dependencies' => [
        'invokables' => [
            MultilanguageServiceInterface::class => MultilanguageService::class
        ],
        'factories' => [
            DbMultilanguageMiddleware::class => DbMultilanguageMiddlewareFactory::class
        ]
    ]
];
