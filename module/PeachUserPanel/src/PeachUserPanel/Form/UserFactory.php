<?php


namespace PeachUserPanel\Form;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return User
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $userForm = new User();
        $userForm->setInputFilter(new UserFilter());

        return $userForm;
    }

}