<?php
namespace AppBundle\Services;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormFieldProvider
{

    public function addField(AbstractType $parentForm, AbstractType $childForm)
    {
        
    }

    public function getFields(AbstractType $form)
    {
        return [
            [
                'name' => 'description',
                'type' => TextType::class, 
                'data' => 'foo'
            ]
        ];
    }
}