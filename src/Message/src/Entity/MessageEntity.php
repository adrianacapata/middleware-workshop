<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 3:50 PM
 */

namespace Apidemia\Message\Entity;

use Dot\Mapper\Entity\Entity;

class MessageEntity extends Entity
{
    protected $id;

    protected $senderId;

    protected $receiverId;

    protected $content;

    protected $dataSent;

    protected $isSeen;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * @param mixed $senderId
     */
    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    /**
     * @return mixed
     */
    public function getReceiverId()
    {
        return $this->receiverId;
    }

    /**
     * @param mixed $receiverId
     */
    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDataSent()
    {
        return $this->dataSent;
    }

    /**
     * @param mixed $dataSent
     */
    public function setDataSent($dataSent)
    {
        $this->dataSent = $dataSent;
    }

    /**
     * @return mixed
     */
    public function getIsSeen()
    {
        return $this->isSeen;
    }

    /**
     * @param mixed $isSeen
     */
    public function setIsSeen($isSeen = '')
    {
        $this->isSeen = $isSeen;
    }
}
