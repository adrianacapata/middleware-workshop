<?php

use Apidemia\Blog\Service\PostServiceInterface;
use Apidemia\Blog\Service\PostService;
use Apidemia\Blog\Factory\PostFactory;
use Apidemia\Blog\Controller\PostFrontendController;
use Apidemia\Blog\Form\ViewForm;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'dependencies' => [
        'invokables' => [
           PostServiceInterface::class => PostService::class
        ],
        'factories' => [
            PostFrontendController::class => PostFactory::class,
        ]
    ],
];
