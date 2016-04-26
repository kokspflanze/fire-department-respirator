<?php


namespace PeachUserPanel\Controller;


use PeachUserPanel\Service\UserPanel;
use Zend\Mvc\Controller\AbstractActionController;

class DetailController extends AbstractActionController
{
    /** @var  UserPanel */
    protected $serviceUserPanel;

    /**
     * EditController constructor.
     * @param UserPanel $serviceUserPanel
     */
    public function __construct(UserPanel $serviceUserPanel)
    {
        $this->serviceUserPanel = $serviceUserPanel;
    }

    public function indexAction()
    {
        $userId = $this->params()->fromRoute('id');

        $user = $this->serviceUserPanel->getUser4Id($userId);
        if (!$user) {
            return $this->redirect()->toRoute('PeachUserPanel');
        }

        return [
            'user' => $user,
            'userForm' => $this->serviceUserPanel->getUserForm()
        ];
    }

    public function editAction()
    {
        $userId = $this->params()->fromRoute('id');

        $user = $this->serviceUserPanel->getUser4Id($userId);
        if (!$user) {
            return $this->redirect()->toRoute('PeachUserPanel');
        }
    }
}