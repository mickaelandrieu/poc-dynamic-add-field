<?php
namespace AppBundle\Services;

use Symfony\Component\Form\AbstractType;

/**
 * Returns a collection of fields to be filled by form.
 */
interface FormFieldProviderInterface
{
    /**
     * @return array
     */
    public function getFormFields();
}