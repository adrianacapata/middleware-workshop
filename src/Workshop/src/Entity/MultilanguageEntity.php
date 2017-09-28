<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/28/2017
 * Time: 3:05 PM
 */

namespace Workshop\Middleware\Entity;

use Dot\Mapper\Entity\Entity;
use function Sodium\crypto_box_keypair_from_secretkey_and_publickey;

class MultilanguageEntity extends Entity
{
    protected $id;

    protected $tag;

    protected $languageCode;

    protected $value;

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
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }
    /**
     * @return mixed
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @param mixed $languageCode
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
