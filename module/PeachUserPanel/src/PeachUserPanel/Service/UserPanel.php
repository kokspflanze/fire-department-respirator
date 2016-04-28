<?php


namespace PeachUserPanel\Service;


use Doctrine\ORM\EntityManager;
use PeachUserPanel\Options\EntityOptions;
use SmallUser\Entity\UserInterface;
use SmallUser\Mapper\HydratorUser;
use Zend\Form\FormInterface;
use Zend\Crypt\Password\Bcrypt;

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
     * @param $data
     * @param UserInterface|null $currentUser
     * @return array|bool|object
     */
    public function editUser($data, UserInterface $currentUser = null)
    {
        if (!$currentUser) {
            /** @var UserInterface $class */
            $class = $this->entityOptions->getUser();
            $currentUser = new $class;
        }

        $this->userForm->setHydrator(new HydratorUser());
        $this->userForm->bind($currentUser);
        $this->userForm->setData($data);

        if (!$this->userForm->isValid()) {
            return false;
        }

        /** @var UserInterface $user */
        $user = $this->userForm->getData();
        if (!$user->getPassword()) {
            $user->setPassword($currentUser->getPassword());
        } else {
            $bCrypt = new Bcrypt();
            $user->setPassword($bCrypt->create($user->getPassword()));
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * @return FormInterface
     */
    public function getUserForm()
    {
        return $this->userForm;
    }

}