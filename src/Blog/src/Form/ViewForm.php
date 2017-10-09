<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/9/2017
 * Time: 3:38 PM
 */

namespace Apidemia\Blog\Form;

use Zend\Form\Form;

class ViewForm extends Form
{
    public function __construct($name = 'ViewForm', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'attributes' => [
                'type' => 'text',
                'value' => 'sth'
            ]
        ]);
    }
}
