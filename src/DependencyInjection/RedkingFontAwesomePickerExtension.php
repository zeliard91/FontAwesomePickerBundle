<?php

namespace Redking\FontAwesomePickerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;


class RedkingFontAwesomePickerExtension extends Extension implements PrependExtensionInterface
{
    /** @var string */
    protected $formTemplate = '@RedkingFontAwesomePicker/Form/fields.html.twig';

    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (true === isset($config['customize'])) {
            $container->setParameter('redking_font_awesome_picker.customize', $config['customize']);
        }


        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * @return void
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);
        
        // Configure Twig if TwigBundle is activated and the option
        // "redking_font_awesome_picker.auto_configure.twig" is set to TRUE (default value).
        if (true === isset($bundles['TwigBundle']) && true === $config['auto_configure']['twig']) {
            $this->configureTwigBundle($container);
        }
    }

    /**
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    protected function configureTwigBundle(ContainerBuilder $container)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
            switch ($name) {
                case 'twig':
                    $container->prependExtensionConfig(
                        $name,
                        array('form_themes'  => array($this->formTemplate))
                    );
                    break;
            }
        }
    }
}
