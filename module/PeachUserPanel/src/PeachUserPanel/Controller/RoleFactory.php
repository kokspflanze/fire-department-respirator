<?php


namespace PeachUserPanel\Controller;


use PeachUserPanel\Service\RoleService;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RoleFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return RoleController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new RoleController(
            $serviceLocator->getServiceLocator()->get(RoleService::class)
        );
    }

}