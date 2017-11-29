<?php

/*
 * This file is part of the ApiApiBundle package.
 *
 * (c) Kévin Api <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZND\SIM\ApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @author mukendi emmanuel <mukendiemmanuel@events.cd>
 */
class EventsApiExtension extends Extension implements PrependExtensionInterface
{

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        if (!isset($bundles['FOSRestBundle'])) {
            throw new \RuntimeException('FOSRestBundle must be installed to use OauthOauthBundle.');
        }

    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);
        $locator= new FileLocator(__DIR__ . '/../Resources/config');
        $loader= new Loader\XmlFileLoader($container,$locator);
    }
}
