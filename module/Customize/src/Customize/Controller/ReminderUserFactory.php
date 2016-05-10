<?php


namespace Customize\Controller;


use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReminderUserFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return ReminderUserController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ReminderUserController();
    }

}