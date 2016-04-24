<?php


namespace Customize\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        return $this->redirect()->toRoute('small-user-auth');
    }
}