<?php


namespace PeachUserPanel\Form;

use Doctrine\ORM\EntityManager;
use PeachUserPanel\Options\EntityOptions;
use Zend\Validator\InArray;
use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class UserRoleFilter extends ProvidesEventsInputFilter
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var EntityOptions
     */
    protected $entityOptions;

    public function __construct(EntityManager $entityManager, EntityOptions $entityOptions)
    {
        $this->entityManager = $entityManager;
        $this->entityOptions = $entityOptions;

        $this->add([
            'name' => 'roleId',
            'required' => true,
            'validators' => [
                new InArray([
                    'haystack' => $this->getRoleList(),
                ]),
            ],
        ]);

    }

    /**
     * @return array
     */
    protected function getRoleList()
    {
        /** @var \SmallUser\Entity\Repository\UserRole $userRoleRepository */
        $userRoleRepository = $this->entityManager->getRepository($this->entityOptions->getUserRole());

        /** @var \SmallUser\Entity\UserRole[] $userRole */
        $userRole = $userRoleRepository->findAll();

        $result = [];
        foreach ($userRole as $entry) {
            $result[] = $entry->getId();
        }

        return $result;
    }

}