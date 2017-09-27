<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/27/2017
 * Time: 4:43 PM
 */

namespace Workshop\Middleware;

use Interop\Container\ContainerInterface;
use Workshop\Middleware\Service\MultilanguageServiceInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DbMultilanguageMiddlewareFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
       $service = $container->get(MultilanguageServiceInterface::class);

       return new DbMultilanguageMiddleware($service);
    }
}
