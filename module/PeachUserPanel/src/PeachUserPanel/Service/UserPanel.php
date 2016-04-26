<?php


namespace PeachUserPanel\Service;


use Doctrine\ORM\EntityManager;
use PeachUserPanel\Options\EntityOptions;
use Zend\Form\FormInterface;

class UserPanel
{
    /** @var  EntityManager */
    protected $entityManager;

    /** @var  EntityOptions */
    protected $entityOptions;

    /** @var  FormInterface */
    protected $userForm;

    /**
     * UserPanel constructor.
     * @param EntityManager $entityManager
     * @param EntityOptions $entityOptions
     * @param FormInterface $userForm
     */
    public function __construct(
        EntityManager $entityManager,
        EntityOptions $entityOptions,
        FormInterface $userForm
    ) {
        $this->entityManager = $entityManager;
        $this->entityOptions = $entityOptions;
        $this->userForm = $userForm;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getUserListQueryBuilder()
    {
        /** @var \SmallUser\Entity\Repository\User $repository */
        $repository = $this->entityManager->getRepository($this->entityOptions->getUser());

        return $repository->createQueryBuilder('p');
    }

    /**
     * @param $userId
     * @return null|\SmallUser\Entity\UserInterface
     */
    public function getUser4Id($userId)
    {
        /** @var \SmallUser\Entity\Repository\User $userRepository */
        $userRepository = $this->entityManager->getRepository($this->entityOptions->getUser());

        return $userRepository->getUser4Id($userId);
    }

    /**
     * @return FormInterface
     */
    public function getUserForm()
    {
        return $this->userForm;
    }

}