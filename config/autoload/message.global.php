<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 4:19 PM
 */
use Apidemia\Message\Service\MessageServiceInterface;
use Apidemia\Message\Service\MessageService;
use Apidemia\Message\Controller\MessageController;
use Apidemia\Message\Factory\MessageFactory;

return [
    'dependencies' => [
        'invokables' => [
            MessageServiceInterface::class => MessageService::class
        ],
        'factories' => [
            MessageController::class => MessageFactory::class,
        ]
    ]
];
