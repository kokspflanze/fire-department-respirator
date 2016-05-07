<?php


namespace PeachUserPanel\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class UserRole extends ProvidesEventsForm
{
    /**
     * UserRole constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct();
        $this->add(
            new Element\Csrf('fdh456eh56ujzum45zkuik45zhrh')
        );

        $this->add([
            'name' => 'roleId',
            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
            'options' => [
                'object_manager' => $entityManager,
                'target_class' => \SmallUser\Entity\UserRole::class,
                'property' => 'roleId',
                'label' => 'Role',
                'empty_option' => '-- select --',
                'is_method' => true,
                'find_method' => [
                    'name' => 'findAll',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Add Role')
            ->setAttributes([
                'class' => 'btn btn-primary',
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);
    }
}