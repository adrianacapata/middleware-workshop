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
    public function __construct()
    {
        parent::__construct('CreateForm');
    }
    public function init()
    {

        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title'
            ],
            'attributes' => [
                'placeholder' => 'Title...'
            ]
        ]);

        $this->add([
            'name' => 'content',
            'type' => 'textarea',
            'options' => [
                'label' => 'Content'
            ],
            'attributes' => [
                'placeholder' => 'Content...'
            ]
        ]);

        $this->add([
            'name' => 'slug',
            'type' => 'text',
            'options' => [
                'label' => 'Slug'
            ],
            'attributes' => [
                'placeholder' => 'Slug...'
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
        return [
            'title' => [
                'filters' => [
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'message' => '<b>Title</b> is required and cannot be empty',
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 3,
                            'max' => 200
                        ]
                    ]
                ],
            ],

            'content' => [
                    'filters' => [
                        ['name' => 'StringTrim']
                    ],
                    'validators' => [
                        [
                            'name' => 'NotEmpty',
                            'break_chain_on_failure' => true,
                            'options' => [
                                'message' => '<b>Content</b> is required and cannot be empty',
                            ]
                        ],
                        [
                            'name' => 'StringLength',
                            'options' => [
                                'min' => 3,
                            ]
                        ]

                    ],
                ],

            'slug' => [
                'filters' => [
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'message' => '<b>Slug</b> is required and cannot be empty',
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 3,
                            'max' => 200
                        ]
                    ]

                ],
            ]
        ];
    }
}
