<?php


namespace PeachUserPanel\Options;


use SmallUser\Entity\User;
use SmallUser\Entity\UserRole;
use Zend\Stdlib\AbstractOptions;

class EntityOptions extends AbstractOptions
{
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $userRole = UserRole::class;

    /**
     * @var string
     */
    protected $user = User::class;

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * @param string $userRole
     * @return self
     */
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;
        return $this;
    }


}