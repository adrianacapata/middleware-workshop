<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/9/2017
 * Time: 3:38 PM
 */

namespace Apidemia\Blog\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterAwareTrait;
use Zend\InputFilter\InputFilterProviderInterface;

class CreateForm extends Form
{

    public function __construct($name = 'CreateForm', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->add([
            'type' => 'ViewFieldset',
            'options' => [
                'use_as_base_fieldset' => true,
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Insert post',
            ]
        ]);
        $this->setValidationGroup([
            'CreateForm' => [
                'title',
                'content',
                'slug'
            ]
        ]);
    }
}
