<?php
namespace AppBundle\Services;

use AppBundle\Services\FormFieldProviderInterface;

use \DateTime;

class DateFieldProvider implements FormFieldProviderInterface
{
    public function getFormFields()
    {
        return [
            'todo' => [
                [
                    'name' => 'date',
                    'type' => 'datetime',
                    'data' => new DateTime(),
                    'options' => [],
                ],
            ],
        ];
    }
}