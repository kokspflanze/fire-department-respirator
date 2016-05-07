<?php


namespace PeachUserPanel\Controller;


use PeachUserPanel\Mapper\UserHydrator;
use PeachUserPanel\Service\RoleService;
use PeachUserPanel\Service\UserPanel;
use SmallUser\Mapper\HydratorUser;
use Zend\Mvc\Controller\AbstractActionController;

class DetailController extends AbstractActionController
{
    /** @var  UserPanel */
    protected $serviceUserPanel;
    /** @var  RoleService */
    protected $roleService;

    /**
     * EditController constructor.
     * @param UserPanel $serviceUserPanel
     * @param RoleService $roleService
     */
    public function __construct(UserPanel $serviceUserPanel, RoleService $roleService)
    {
        $this->serviceUserPanel = $serviceUserPanel;
        $this->roleService = $roleService;
    }

    /**
     * @return array|\Zend\Http\Response
     */
    public function indexAction()
    {
        $userId = $this->params()->fromRoute('id');

        $user = $this->serviceUserPanel->getUser4Id($userId);
        if (!$user) {
            return $this->redirect()->toRoute('PeachUserPanel');
        }

        return [
            'user' => $user,
            'roleForm' => $this->roleService->getAdminUserRoleForm(),
        ];
    }

    public function editAction()
    {
        $userId = $this->params()->fromRoute('id');

        $user = $this->serviceUserPanel->getUser4Id($userId);
        if (!$user) {
            return $this->redirect()->toRoute('PeachUserPanel');
        }

        $userForm = $this->serviceUserPanel->getUserForm();

        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($this->serviceUserPanel->editUser($this->params()->fromPost(), $user)) {
                return $this->redirect()->toRoute('PeachUserPanel');
            }
        } else {
            $userForm->setHydrator(new HydratorUser());
            $userForm->bind($user);
        }

        return [
            'user' => $user,
            'userForm' => $userForm
        ];
    }

    /**
     * @return array
     */
    public function newAction()
    {
        $userForm = $this->serviceUserPanel->getUserForm();

        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = $this->serviceUserPanel->editUser($this->params()->fromPost());
            if ($user) {
                return $this->redirect()->toRoute('PeachUserPanel');
            }
        }

        return [
            'userForm' => $userForm
        ];
    }
}