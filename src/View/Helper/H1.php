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

use Zend\View\Helper\HeadTitle;

/**
 * Class H1
 *
 * Helper for setting and retrieving h1 element titles
 *
 * @package TravelloViewHelper\View\Helper
 */
class H1 extends HeadTitle
{
    /**
     * Registry key for placeholder
     *
     * @var string
     */
    protected $regKey = 'TravelloViewHelper_View_Helper_H1';

    /**
     * Flag whether to automatically escape output, must also be
     * enforced in the child class if __toString/toString is overridden
     *
     * @var bool
     */
    protected $autoEscape = false;

    /**
     * What string to use between individual items in the placeholder
     * when rendering
     *
     * @var string
     */
    protected $separator = ' &raquo; ';

    /**
     * Turn helper into string
     *
     * @param  string|null $indent
     *
     * @return string
     */
    public function toString($indent = null)
    {
        $output = parent::toString($indent);
        $output = str_replace(
            ['<title>', '</title>'], ['<h1>', '</h1>'], $output
        );

        if ($output == '<h1></h1>') {
            return '';
        }

        return $output;
    }
}
