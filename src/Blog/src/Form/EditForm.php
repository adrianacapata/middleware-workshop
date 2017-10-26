<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/26/2017
 * Time: 4:46 PM
 */

namespace Apidemia\Blog\Form;

use Zend\Form\Form;

class EditForm extends Form
{
    public function __construct($name = 'EditForm', array $options = [])
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
                'value' => 'Update post',
            ]
        ]);
        $this->setValidationGroup([
            'EditForm' => [
                'title',
                'content',
                'slug'
            ]
        ]);
//        var_dump($this->getValidationGroup());exit;
    }
}
