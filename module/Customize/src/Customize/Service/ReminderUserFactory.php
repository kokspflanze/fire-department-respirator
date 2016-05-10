<?php


namespace Customize\Service;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReminderUserFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ReminderUser
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ReminderUser();
    }

}