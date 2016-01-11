<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    ZendViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/zend-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ZendViewHelper;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * ZendViewHelper module class
 *
 * @package    ZendViewHelper
 */
class Module implements ConfigProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
