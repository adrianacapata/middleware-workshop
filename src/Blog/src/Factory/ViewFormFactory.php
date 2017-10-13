<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 10/10/2017
 * Time: 2:00 PM
 */

namespace Apidemia\Blog\Factory;

use Apidemia\Blog\Form\ViewForm;
use Psr\Container\ContainerInterface;

class ViewFormFactory
{
    public function __invoke()
    {
//        $container = $container->get('config');
        return new ViewForm();
    }
}
