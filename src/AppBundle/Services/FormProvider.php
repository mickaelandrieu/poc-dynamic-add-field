<?php
namespace AppBundle\Services;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\ParameterBag;

class FormProvider implements FormProviderInterface
{
    /**
     * @var ParameterBag
     */
    private $fields;

    /**
     * @var FormFactory
     */
    private $formFactory;

    public function __construct(FormFactory $formFactory)
    {
        $this->fields = new ParameterBag();
        $this->formFactory = $formFactory;
    }

    public function addFieldProvider(FormFieldProviderInterface $fieldProvider)
    {
        foreach($fieldProvider->getFormFields() as $formName => $fields) {
            if (!$this->fields->has($formName)) {
                $this->fields->set($formName, array());
            }

            $forms = $this->fields->get($formName);
            foreach($fields as $field) {
                $forms[] = $this->formFactory->createNamed(
                    $field['name'],
                    $field['type'],
                    $field['data'],
                    array_merge(
                        $field['options'],
                        [
                            'auto_initialize' => false,
                        ]
                    )
                );
            }

            $this->fields->set($formName, $forms);

        }
    }

    public function getFields(AbstractType $form)
    {
        return $this->fields->get($form->getBlockPrefix());
    }
}