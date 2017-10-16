<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 4:06 PM
 */

namespace Apidemia\Message\Controller;

use Apidemia\Message\Entity\MessageEntity;
use Apidemia\Message\Service\MessageServiceInterface;
use Dot\Controller\AbstractActionController;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;

class MessageController extends AbstractActionController
{
    public function __construct(MessageServiceInterface $messageService)
    {
        $this->messageService = $messageService;
    }

    public function indexAction(): ResponseInterface
    {
        $data['post'] = $this->messageService->listMessages();
        $data['users'] = $this->messageService->getUsers();

//        $loggedUser = $this->authentication()->getIdentity()->getId();
//        $data['messages'] = $this->messageService->listConversations($loggedUser);
//        var_dump(end($data['post'])); exit;
        foreach ($data['post'] as $message) {
            if ($message->getIsSeen() == 0) {
                $message->setIsSeen(1);
                $this->messageService->sendMessage($message);
            }
        }
        return new HtmlResponse($this->template('message::list', $data));
    }

    public function createAction()
    {
        $data['users'] = $this->messageService->getUsers();

        $senderId = $this->authentication()->getIdentity()->getId();

        $createMessage = $this->getRequest()->getParsedBody();
        $result = ['succes' => false,'message' => 'An error has ocurred'];

        if (!empty($createMessage)) {
            $storage = new MessageEntity();

            $storage->setContent($createMessage['message']);
            $storage->setSenderId($senderId);
            $storage->setReceiverId($createMessage['receiverId']);
            $storage->setIsSeen();

            $data['post'] = $this->messageService->sendMessage($storage);
        }
        $result = ['succes' => 'true', 'receiverId' => $createMessage['receiverId'], 'message' => $createMessage['message']];

        return new JsonResponse($result);
    }

    public function sendMessageAction()
    {
        $data['users'] = $this->messageService->getUsers();

        $senderId = $this->authentication()->getIdentity()->getId();

        $createMessage = $this->getRequest()->getParsedBody();

        if (!empty($createMessage)) {
            $storage = new MessageEntity();

            $storage->setContent($createMessage['content']);
            $storage->setSenderId($senderId);
            $storage->setReceiverId($createMessage['receiverId']);
            $storage->setIsSeen();
            $data['post'] = $this->messageService->sendMessage($storage);
        }
        return new RedirectResponse($this->url('message', ['action' => 'index']));
    }
}
