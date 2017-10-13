<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 3:59 PM
 */

namespace Apidemia\Message\Service;

use Apidemia\Message\Entity\MessageEntity;

interface MessageServiceInterface
{
    public function sendMessage(MessageEntity $message);

    public function listMessages();

    public function listConversations($receiverId);
}
