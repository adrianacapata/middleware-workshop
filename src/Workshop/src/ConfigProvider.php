<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/28/2017
 * Time: 3:29 PM
 */

namespace Workshop\Middleware;

use Dot\Mapper\Factory\DbMapperFactory;
use Workshop\Middleware\Entity\MultilanguageEntity;
use Workshop\Middleware\Mapper\MultilanguageDbMapper;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dot_mapper' => $this->getMappers()
        ];
    }

    public function getMappers(): array
    {
        return [
            'mapper_manager' => [
                'factories' => [
                    MultilanguageDbMapper::class => DbMapperFactory::class
                ],
                'aliases' => [
                    MultilanguageEntity::class => MultilanguageDbMapper::class
                ]
            ]
        ];
    }
}
