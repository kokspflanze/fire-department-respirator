<?php

namespace PeachUserPanel;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module
{
    /**
     * @param ModuleManager $mm
     */
    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__, 'dispatch', function ($e) {
            /** @var MvcEvent $e */
            $e->getTarget()->layout('layout/layout');
        }, 100);
    }
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            \Zend\Loader\StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [];
    }

}
