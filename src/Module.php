<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    TravelloViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/travello-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelloViewHelper;

/**
 * TravelloViewHelper module class
 *
 * @package    TravelloViewHelper
 */
class Module
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        $provider = new ConfigProvider();

        return $provider();
    }
}
