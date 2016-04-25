<?php


namespace PeachUserPanel\Controller;


use PeachUserPanel\Service\UserPanel;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EditFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return EditController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new EditController(
            $serviceLocator->getServiceLocator()->get(UserPanel::class)
        );
    }

}