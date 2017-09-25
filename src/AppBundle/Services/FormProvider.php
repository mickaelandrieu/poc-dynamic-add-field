<?php
namespace AppBundle\Services;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\ParameterBag;

class FormProvider implements FormProviderInterface
{
    private $fields;

    public function __construct()
    {
        $this->fields = new ParameterBag();
    }

    public function addFieldProvider(FormFieldProviderInterface $fieldProvider)
    {
        foreach($fieldProvider->getFormFields() as $formName => $fields) {
            if (!$this->fields->has($formName)) {
                $this->fields->set($formName, array());
            }

            $forms = $this->fields->get($formName);
            foreach($fields as $field) {
                $forms[] = $field;
            }

            $this->fields->set($formName, $forms);

        }
    }

    public function getFields(AbstractType $form)
    {
        return $this->fields->get($form->getBlockPrefix());
    }
}