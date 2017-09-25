<?php
namespace AppBundle\Services;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class FormProvider implements FormProviderInterface
{
    /**
     * @var ParameterBag
     */
    private $fields;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
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
                if ($field instanceof FormInterface) {
                    $forms[] = $field;

                    continue;
                }

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