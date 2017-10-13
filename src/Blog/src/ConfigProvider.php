<?php

/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/28/2017
 * Time: 3:29 PM
 */

namespace Apidemia\Blog;

use Apidemia\Blog\Entity\PostEntity;
use Apidemia\Blog\Factory\ViewFormFactory;
use Apidemia\Blog\Form\ViewFieldset;
use Apidemia\Blog\Mapper\PostMapper;
use Apidemia\Blog\Form\ViewForm;
use Dot\Mapper\Factory\DbMapperFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dot_mapper' => $this->getMappers(),

            'templates' => $this->getTemplates(),

            'dot_form' => $this->getForms(),
        ];
    }

    public function getMappers(): array
    {
        return [
            'mapper_manager' => [
                'factories' => [
                    PostMapper::class => DbMapperFactory::class
                ],
                'aliases' => [
                    PostEntity::class => PostMapper::class
                ]
            ]
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'blog' => [__DIR__ . '/../templates/blog'],
            ],
        ];
    }

    public function getForms()
    {
        return [
            'form_manager' => [
                'factories' => [
                   ViewFieldset::class => InvokableFactory::class,
                   ViewForm::class => ViewFormFactory::class,
                ],
                'aliases' => [
                    'ViewFieldset' =>ViewFieldset::class,
                    'ViewForm' => ViewForm::class,
                ]
            ],
        ];
    }
}
