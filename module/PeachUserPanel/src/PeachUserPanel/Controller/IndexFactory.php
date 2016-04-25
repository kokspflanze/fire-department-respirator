<?php


namespace PeachUserPanel\Controller;


use PeachUserPanel\Service\UserPanel;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use ZfcDatagrid\Datagrid;

class IndexFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return IndexController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new IndexController(
            $serviceLocator->getServiceLocator()->get(Datagrid::class),
            $serviceLocator->getServiceLocator()->get(UserPanel::class),
            $serviceLocator->getServiceLocator()->get(PhpRenderer::class)
        );
    }

}