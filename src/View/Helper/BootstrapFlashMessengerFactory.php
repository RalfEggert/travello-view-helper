<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    TravelloViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/travello-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelloViewHelper\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class BootstrapFlashMessengerFactory
 *
 * Generates the BootstrapFlashMessenger view helper object
 *
 * @package TravelloViewHelper\View\Helper
 */
class BootstrapFlashMessengerFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return BootstrapFlashMessenger
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $controllerPluginManager = $container->get(
            'ControllerPluginManager'
        );

        $plugin = $controllerPluginManager->get('flashMessenger');

        $helper = new BootstrapFlashMessenger($plugin);

        return $helper;
    }
}
