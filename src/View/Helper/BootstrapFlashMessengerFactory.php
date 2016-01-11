<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    ZendViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/zend-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ZendViewHelper\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class BootstrapFlashMessengerFactory
 *
 * Generates the BootstrapFlashMessenger view helper object
 *
 * @package ZendViewHelper\View\Helper
 */
class BootstrapFlashMessengerFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param ServiceLocatorInterface|ServiceLocatorAwareInterface $viewHelperManager
     *
     * @return BootstrapFlashMessenger
     */
    public function createService(
        ServiceLocatorInterface $viewHelperManager
    ) {
        $serviceManager = $viewHelperManager->getServiceLocator();

        $controllerPluginManager = $serviceManager->get(
            'ControllerPluginManager'
        );

        $plugin = $controllerPluginManager->get('flashMessenger');

        $helper = new BootstrapFlashMessenger($plugin);

        return $helper;
    }
}
