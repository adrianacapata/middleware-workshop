<?php
/**
 * Created by PhpStorm.
 * User: Adriana
 * Date: 9/29/2017
 * Time: 5:01 PM
 */

namespace Apidemia\Blog\Factory;

use Apidemia\Blog\Controller\PostFrontendController;
use Apidemia\Blog\Service\PostServiceInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class PostFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = $container->get(PostServiceInterface::class);
        return new PostFrontendController($service);
    }
}
