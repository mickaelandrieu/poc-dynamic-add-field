<?php
namespace AppBundle\Services;

use AppBundle\Services\FormFieldProviderInterface;
use Symfony\Component\Form\FormFactory;

class DescriptionFieldProvider implements FormFieldProviderInterface
{
    private $formFactory;

    public function __construct(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getFormFields()
    {
        return [
            'todo' => [
                $this->formFactory->createNamed('description', 'text', 'A description', [
                    'auto_initialize' => false
                ]),
            ],
        ];
    }
}