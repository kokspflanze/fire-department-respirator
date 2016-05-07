<?php


namespace PeachUserPanel\Controller;

use PeachUserPanel\Service\RoleService;
use Zend\Mvc\Controller\AbstractActionController;

class RoleController extends AbstractActionController
{
    /** @var  RoleService */
    protected $userRoleService;

    /** @var string */
    protected $userDetailRoute = 'PeachUserPanel/detail';

    /**
     * UserRoleController constructor.
     * @param RoleService $userRoleService
     */
    public function __construct(RoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    /**
     * @return \Zend\Http\Response
     */
    public function addAction()
    {
        $usrId = $this->params()->fromRoute('id');
        $this->userRoleService->addRoleForm($this->params()->fromPost(), $usrId);

        return $this->redirect()->toRoute($this->userDetailRoute, ['id' => $usrId]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function removeAction()
    {
        $usrId = $this->params()->fromRoute('id');
        $roleId = $this->params()->fromRoute('roleId');
        $this->userRoleService->removeRole($usrId, $roleId);

        return $this->redirect()->toRoute($this->userDetailRoute, ['id' => $usrId]);
    }
}