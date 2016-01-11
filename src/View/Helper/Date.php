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

use DateTime;
use IntlDateFormatter;
use Zend\View\Helper\AbstractHelper;

/**
 * Class Date
 *
 * Simplifies the date output for the dateFormat view helper
 *
 * @package ZendViewHelper\View\Helper
 */
class Date extends AbstractHelper
{
    /**
     * get string date and output it
     *
     * @param string $date
     * @param string $mode
     *
     * @return boolean
     */
    public function __invoke($date, $mode = 'medium')
    {
        if ($date == '0000-00-00 00:00:00') {
            return '-';
        }

        switch ($mode) {
            case 'long':
                $dateType = IntlDateFormatter::LONG;
                $timeType = IntlDateFormatter::LONG;
                break;

            case 'short':
                $dateType = IntlDateFormatter::SHORT;
                $timeType = IntlDateFormatter::SHORT;
                break;

            case 'dateonly':
                $dateType = IntlDateFormatter::MEDIUM;
                $timeType = IntlDateFormatter::NONE;
                break;

            default:
            case 'medium':
                $dateType = IntlDateFormatter::MEDIUM;
                $timeType = IntlDateFormatter::MEDIUM;
                break;
        }

        if (!$date instanceof DateTime) {
            $date = new DateTime($date);
        }

        return $this->getView()->dateFormat($date, $dateType, $timeType);
    }
}
