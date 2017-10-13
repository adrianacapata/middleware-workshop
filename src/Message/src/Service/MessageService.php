<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 3:58 PM
 */

namespace Apidemia\Message\Service;

use Apidemia\Message\Entity\MessageEntity;
use Dot\Mapper\Mapper\MapperManagerAwareInterface;
use Dot\Mapper\Mapper\MapperManagerAwareTrait;

class MessageService implements MapperManagerAwareInterface, MessageServiceInterface
{
    use MapperManagerAwareTrait;

    public function sendMessage(MessageEntity $message)
    {
        $mapper = $this->getMapperManager()->get(MessageEntity::class);
        return $result = $mapper->save($message);
    }

    public function listMessages()
    {
        $options = [
            'fields' => '*'
        ];

        $mapper = $this->getMapperManager()->get(MessageEntity::class);
        $result = $mapper->find('all', $options);
        return $result;
    }

    public function listConversations($receiverId)
    {
        $mapper = $this->getMapperManager()->get(MessageEntity::class);
        $options = [
            'conditions' => [
                'receiverId' => $receiverId
            ],
        ];
        $result = $mapper->find('all', $options);
        return $result;
    }

    public function getUsers()
    {
        $mapper = $this->getMapperManager()->get(MessageEntity::class);

        $table = 'user';
        $where = [];

        $result = $mapper->getQueryResult($table, $where);
        return $result;
    }
}
