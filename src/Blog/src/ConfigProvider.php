<?php

/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/28/2017
 * Time: 3:29 PM
 */

namespace Apidemia\Blog;

use Apidemia\Blog\Entity\PostEntity;
use Apidemia\Blog\Mapper\PostMapper;
use Dot\Mapper\Factory\DbMapperFactory;
use Workshop\Middleware\Entity\MultilanguageEntity;
use Workshop\Middleware\Mapper\MultilanguageDbMapper;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dot_mapper' => $this->getMappers(),

            'templates' => $this->getTemplates(),
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
}
