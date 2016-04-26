<?php


namespace PeachUserPanel\Controller;


use PeachUserPanel\Service\UserPanel;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DetailFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return DetailController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DetailController(
            $serviceLocator->getServiceLocator()->get(UserPanel::class)
        );
    }

}