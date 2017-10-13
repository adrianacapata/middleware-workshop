<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/9/2017
 * Time: 3:38 PM
 */

namespace Apidemia\Blog\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class ViewForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = 'ViewForm', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->add([
            'name' => 'Title',
            'type' => 'text',
            'options' => [
                'label' => 'Title'
            ],
            'attributes' => [
                'placeholder' => 'Title...'
            ]
        ]);

        $this->add([
            'name' => 'Content',
            'type' => 'text',
            'options' => [
                'label' => 'Content'
            ],
            'attributes' => [
                'placeholder' => 'Content...'
            ]
        ]);

        $this->add([
            'name' => 'Slug',
            'type' => 'text',
            'options' => [
                'label' => 'Slug'
            ],
            'attributes' => [
                'placeholder' => 'Slug...'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Submit'
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'email' => [
                'filters' => [
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'message' => '<b>Field</b> is required and cannot be empty',
                        ]
                    ],

                ],
            ]
        ];
    }
}
