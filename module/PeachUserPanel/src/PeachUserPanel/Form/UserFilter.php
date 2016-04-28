<?php


namespace PeachUserPanel\Form;

use Zend\Filter;
use Zend\I18n\Validator\Alnum;
use Zend\Validator;
use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class UserFilter extends ProvidesEventsInputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'username',
            'required' => true,
            'filters' => [
                new Filter\StringTrim()
            ],
            'validators' => [
                new Validator\StringLength([
                    'min' => 3,
                    'max' => 32,
                ]),
                new Alnum()
            ],
        ]);

        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                new Filter\StringTrim()
            ],
            'validators' => [
                new Validator\EmailAddress([
                    'allow' => Validator\Hostname::ALLOW_DNS,
                    'useMxCheck' => true,
                    'useDeepMxCheck' => true
                ])
            ],
        ]);

        $this->add([
            'name' => 'password',
            'allow_empty' => true,
            'filters' => [
                new Filter\StringTrim()
            ],
            'validators' => [
                new Validator\StringLength([
                    'max' => 32,
                ]),
                new Validator\NotEmpty()
            ],
        ]);

        $this->add([
            'name' => 'passwordVerify',
            'allow_empty' => true,
            'filters' => [
                new Filter\StringTrim()
            ],
            'validators' => [
                new Validator\StringLength([
                    'max' => 32,
                ]),
                new Validator\Identical([
                    'token' => 'password',
                ]),
                new Validator\NotEmpty()
            ],
        ]);
    }


}