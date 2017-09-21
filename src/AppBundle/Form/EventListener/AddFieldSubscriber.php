<?php
namespace AppBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Services\FormFieldProvider;

class AddFieldSubscriber implements EventSubscriberInterface
{
    /**
     * @var AbstractType
     */
    private $formType;

    /**
     * @var FormFieldProvider
     */
    private $fieldProvider;

    public function __construct(FormFieldProvider $fieldProvider, AbstractType $formType)
    {
        $this->fieldProvider = $fieldProvider;
        $this->formType = $formType;
    }

    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();

        foreach($this->fieldProvider->getFields($this->formType) as $field) {
            $form->add($field['name'], $field['type'], [
                'data' => $field['data'],
            ]);
        }
    }
}