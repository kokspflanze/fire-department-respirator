<?php


namespace PeachUserPanel\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class User extends ProvidesEventsForm
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'type' => Element\Csrf::class,
            'name' => 'ghke5uj5ejtbn5eb468n768m67t'
        ]);

        $this->add([
            'name' => 'username',
            'options' => [
                'label' => 'Username',
            ],
            'attributes' => [
                'placeholder' => 'Username',
                'class' => 'form-control',
                'type' => 'text',
                'required' => true,
            ],
        ]);

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'placeholder' => 'Email',
                'class' => 'form-control',
                'type' => 'email',
                'required' => true,
            ],
        ]);

        $this->add([
            'name' => 'password',
            'options' => [
                'label' => 'Password',
            ],
            'attributes' => [
                'placeholder' => 'Password',
                'class' => 'form-control',
                'type' => 'password',
            ],
        ]);

        $this->add([
            'name' => 'passwordVerify',
            'options' => [
                'label' => 'Password Verify',
            ],
            'attributes' => [
                'placeholder' => 'Password Verify',
                'class' => 'form-control',
                'type' => 'password',
            ],
        ]);

        $submitElement = new Element\Button('submit');
        $submitElement->setLabel('Submit')
            ->setAttributes([
                'class' => 'btn btn-default',
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);
    }

}