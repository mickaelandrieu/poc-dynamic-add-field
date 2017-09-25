<?php
namespace AppBundle\Services;

use Symfony\Component\Form\AbstractType;
use AppBundle\Services\FormFieldProviderInterface;

/**
 *
 */
interface FormProviderInterface
{
    /**
     * @param FormFieldProviderInterface $field
     * @return void
     */
    public function addFieldProvider(FormFieldProviderInterface $field);

    /**
     * @param AbstractType $form
     * @return AbstractType[]
     */
    public function getFields(AbstractType $form);
}