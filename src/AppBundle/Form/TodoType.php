<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Form\EventListener\AddFieldSubscriber;
use AppBundle\Services\FormProviderInterface;

class TodoType extends AbstractType
{
    private $formFieldProvider;

    public function __construct(FormProviderInterface $formFieldProvider)
    {
        $this->formFieldProvider = $formFieldProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formFieldProvider = $this->formFieldProvider;
        $builder
            ->add('todo', TextType::class)
            ->add('dueDate', DateType::class, array('widget' => 'single_text'))
            ->add('save', SubmitType::class)
        ;

        $builder->addEventSubscriber(new AddFieldSubscriber($formFieldProvider, $this));
    }
}
