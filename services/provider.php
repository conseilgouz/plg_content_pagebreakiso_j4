<?php
/**
 * @package  Content.pagebreakiso : bug in pagination 
 *
 * @copyright   Copyright (C) 2024 ConseilGouz. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * 
 * bug in Joomla 3.8 => https://github.com/joomla/joomla-cms/issues/17305
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Conseilgouz\Plugin\Content\PageBreakIso\Extension\PageBreakIso;

return new class () implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   4.4.0
     */
    public function register(Container $container): void
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {
                $plugin     = new PageBreakIso(
                    $container->get(DispatcherInterface::class),
                    (array) PluginHelper::getPlugin('content', 'pagebreakiso')
                );
                $plugin->setApplication(Factory::getApplication());

                return $plugin;
            }
        );
    }
};
