<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class PopulateFormFieldProviderPass implements CompilerPassInterface
{
    const DEFINITION = 'app.form_field.provider';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(self::DEFINITION)) {
            return;
        }

        $definition = $container->findDefinition(self::DEFINITION);
        $taggedServices = $container->findTaggedServiceIds('form.field_provider');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addFieldProvider', array(new Reference($id)));
        }
    }
}