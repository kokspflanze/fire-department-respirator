<?php


namespace PeachUserPanel\Service;

use Doctrine\ORM\EntityManager;
use PeachUserPanel\Form\User;
use PeachUserPanel\Options\EntityOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserPanelFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return UserPanel
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new UserPanel(
            $serviceLocator->get(EntityManager::class),
            new EntityOptions(),
            $serviceLocator->get(User::class)
        );
    }

}