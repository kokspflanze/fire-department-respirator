<?php


namespace PeachUserPanel\Form;


use Doctrine\ORM\EntityManager;
use PeachUserPanel\Options\EntityOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserRoleFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        $userRole = new UserRole($serviceLocator->get(EntityManager::class));

        /** @noinspection PhpParamsInspection */
        $userRole->setInputFilter(
            new UserRoleFilter(
                $serviceLocator->get(EntityManager::class),
                new EntityOptions()
            )
        );

        return $userRole;
    }

}