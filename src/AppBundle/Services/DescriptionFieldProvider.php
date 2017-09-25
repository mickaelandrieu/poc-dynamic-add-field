<?php
namespace AppBundle\Services;

use AppBundle\Services\FormFieldProviderInterface;

class DescriptionFieldProvider implements FormFieldProviderInterface
{
    public function getFormFields()
    {
        return [
            'todo' => [
                [
                    'name' => 'description',
                    'type' => 'text',
                    'data' => 'A description',
                    'options' => [],
                ],
            ],
        ];
    }
}