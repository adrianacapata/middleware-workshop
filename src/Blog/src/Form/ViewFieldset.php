<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 2:08 PM
 */

namespace Apidemia\Blog\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ViewFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init()
    {
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Name'
            ],
            'attributes' => [
                'placeholder' => 'Your name...'
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
        return [
//            'email' => [
//                'filters' => [
//                    ['name' => 'StringTrim']
//                ],
//                'validators' => [
//                    [
//                        'name' => 'NotEmpty',
//                        'break_chain_on_failure' => true,
//                        'options' => [
//                            'message' => '<b>E-mail</b> address is required and cannot be empty',
//                        ]
//                    ],
//                    [
//                        'name' => 'EmailAddress',
//                        'options' => [
//                            'message' => '<b>E-mail</b> address is invalid',
//                        ]
//                    ],
//                ],
//            ]
            ];
    }
}
