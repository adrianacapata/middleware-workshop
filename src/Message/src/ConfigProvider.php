<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 3:47 PM
 */
namespace Apidemia\Message;

use Apidemia\Message\Mapper\MessageMapper;
use Apidemia\Message\Entity\MessageEntity;
use Dot\Mapper\Factory\DbMapperFactory;

class ConfigProvider
{
    public function __invoke()
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
                    MessageMapper::class => DbMapperFactory::class
                ],
                'aliases' => [
                    MessageEntity::class => MessageMapper::class
                ]
            ]
        ];
    }

    public function getTemplates(): array
    {
        return [
          'paths' => [
              'message' => [__DIR__ . '/../templates/message']
          ]
        ];
    }
}
