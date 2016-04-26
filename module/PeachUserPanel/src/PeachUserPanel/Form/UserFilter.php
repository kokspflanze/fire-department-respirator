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
            'filters' => [
                new Filter\StringTrim()
            ],
            'validators' => [
                new Validator\StringLength([
                    'min' => 3,
                    'max' => 32,
                ])
            ],
        ]);

        $this->add([
            'name' => 'passwordVerify',
            'filters' => [
                new Filter\StringTrim()
            ],
            'validators' => [
                new Validator\StringLength([
                    'min' => 3,
                    'max' => 32,
                ])
                ,
                new Validator\Identical([
                    'token' => 'password',
                ])
            ],
        ]);
    }


}