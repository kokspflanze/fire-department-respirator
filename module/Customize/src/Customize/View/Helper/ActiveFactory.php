<?php


namespace Customize\View\Helper;


use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ActiveFactory implements FactoryInterface
{

    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return Active
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new Active(
            $serviceLocator->getServiceLocator()->get('router'),
            $serviceLocator->getServiceLocator()->get('request')
        );
    }

}