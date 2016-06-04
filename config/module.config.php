<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    TravelloViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/travello-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use TravelloViewHelper\View\Helper\BootstrapFlashMessenger;
use TravelloViewHelper\View\Helper\BootstrapFlashMessengerFactory;
use TravelloViewHelper\View\Helper\BootstrapForm;
use TravelloViewHelper\View\Helper\Date;
use TravelloViewHelper\View\Helper\H1;

return [
    'view_helpers' => [
        'aliases'   => [
            'h1'                      => H1::class,
            'date'                    => Date::class,
            'bootstrapForm'           => BootstrapForm::class,
            'bootstrapFlashMessenger' => BootstrapFlashMessenger::class,
        ],
        'factories' => [
            H1::class                      => H1::class,
            Date::class                    => Date::class,
            BootstrapForm::class           => BootstrapForm::class,
            BootstrapFlashMessenger::class =>
                BootstrapFlashMessengerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map'        => include __DIR__ . '/../template_map.php',
        'template_path_stack' => [__DIR__ . '/../view',],
    ],
];
