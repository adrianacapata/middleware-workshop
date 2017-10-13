<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/13/2017
 * Time: 3:51 PM
 */

namespace Apidemia\Message\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class SendMessageForm extends Form implements InputFilterProviderInterface
{

    public function __construct($name = 'SendMessageForm', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->add([
            'name' => 'message',
            'type' => 'text',
            'options' => [
                'label' => 'Message'
            ],
            'attributes' => [
                'placeholder' => '...'
            ]
        ]);

        $this->add([
            'name' => 'send',
            'type' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Send to'
            ]
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        // TODO: Implement getInputFilterSpecification() method.
    }
}
