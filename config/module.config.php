<?php
/**
 * Zend Framework 3 module with a couple of useful view helper
 *
 * @package    ZendViewHelper
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/zend-view-helper
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */
return [
    'view_helpers' => [
        'invokables' => [
            'h1'            => ZendViewHelper\View\Helper\H1::class,
            'date'          => ZendViewHelper\View\Helper\Date::class,
            'bootstrapForm' =>
                ZendViewHelper\View\Helper\BootstrapForm::class,
        ],
        'factories'  => [
            'bootstrapFlashMessenger' =>
                ZendViewHelper\View\Helper\BootstrapFlashMessengerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map'        => include __DIR__ . '/../template_map.php',
        'template_path_stack' => [__DIR__ . '/../view',],
    ],
];
