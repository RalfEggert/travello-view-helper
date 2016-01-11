<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    TravelloViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/travello-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */
return [
    'view_helpers' => [
        'invokables' => [
            'h1'            => TravelloViewHelper\View\Helper\H1::class,
            'date'          => TravelloViewHelper\View\Helper\Date::class,
            'bootstrapForm' =>
                TravelloViewHelper\View\Helper\BootstrapForm::class,
        ],
        'factories'  => [
            'bootstrapFlashMessenger' =>
                TravelloViewHelper\View\Helper\BootstrapFlashMessengerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map'        => include __DIR__ . '/../template_map.php',
        'template_path_stack' => [__DIR__ . '/../view',],
    ],
];
