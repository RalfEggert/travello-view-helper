<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    TravelloViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/travello-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 */

namespace TravelloViewHelper\View\Helper;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Zend\View\Helper\AbstractHelper;

/**
 * Class BootstrapMenu
 *
 * Render a form in Twitter Bootstrap style
 *
 * @package TravelloViewHelper\View\Helper
 */
class BootstrapMenu extends AbstractHelper
{
    /**
     * get rendered menu and adds drop down markup
     *
     * @param string $html  rendered navigation
     * @param string $class css class to check for adding drop down
     *
     * @return string
     */
    public function __invoke($html, $class = 'toplevel', $toggle = false)
    {
        $domDoc = new DOMDocument('1.0', 'utf-8');
        $domDoc->loadXML('<?xml version="1.0" encoding="utf-8"?>' . $html);

        $xpath = new DOMXPath($domDoc);

        /** @var DOMElement $item */
        foreach (
            $xpath->query('//a[starts-with(@class, "' . $class . '")]') as $item
        ) {
            $result = $xpath->query('../ul', $item);

            if ($result->length === 1) {
                /** @var DOMElement $ul */
                $ul = $result->item(0);
                $ul->setAttribute('class', 'dropdown-menu');

                /** @var DOMElement $li */
                $li = $item->parentNode;
                $li->setAttribute('id', substr($item->getAttribute('href'), 1));

                if (($existingClass = $li->getAttribute('class')) !== '') {
                    $li->setAttribute('class', $existingClass . ' dropdown');
                } else {
                    $li->setAttribute('class', 'dropdown');
                }

                if ($toggle) {
                    $item->setAttribute('data-toggle', 'dropdown');
                }

                if (($existingClass = $item->getAttribute('class')) !== '') {
                    $item->setAttribute(
                        'class',
                        $item->getAttribute('class') . ' dropdown-toggle'
                    );
                } else {
                    $item->setAttribute('class', 'dropdown-toggle');
                }

                $space = $domDoc->createTextNode(' ');

                $item->appendChild($space);

                $caret = $domDoc->createElement('b', '');
                $caret->setAttribute('class', 'caret');

                $item->appendChild($caret);
            }
        }

        return $domDoc->saveXML(
            $xpath->query('/ul')->item(0), LIBXML_NOEMPTYTAG
        );
    }
}
