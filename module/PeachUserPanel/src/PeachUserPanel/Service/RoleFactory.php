<?php


namespace PeachUserPanel\Service;


use Doctrine\ORM\EntityManager;
use PeachUserPanel\Form\UserRole;
use PeachUserPanel\Options\EntityOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RoleFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new RoleService(
            $serviceLocator->get(EntityManager::class),
            $serviceLocator->get(UserRole::class),
            new EntityOptions(),
            $serviceLocator->get('ControllerPluginManager')
        );
    }

}