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

use TravelloViewHelper\View\Helper\BootstrapFlashMessenger;
use TravelloViewHelper\View\Helper\BootstrapFlashMessengerFactory;
use TravelloViewHelper\View\Helper\BootstrapForm;
use TravelloViewHelper\View\Helper\BootstrapMenu;
use TravelloViewHelper\View\Helper\Date;
use TravelloViewHelper\View\Helper\H1;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Class ConfigProvider
 *
 * @package TravelloViewHelper
 */
class ConfigProvider
{
    /**
     * Returns configuration from file
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'view_helpers' => $this->getViewHelperConfig(),
            'view_manager' => $this->getViewManagerConfig(),
            'templates'    => $this->getTemplatesConfig(),
        ];
    }

    /**
     * Get view helper configuration
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'aliases'   => [
                'h1'                      => H1::class,
                'date'                    => Date::class,
                'bootstrapForm'           => BootstrapForm::class,
                'bootstrapMenu'           => BootstrapMenu::class,
                'bootstrapFlashMessenger' => BootstrapFlashMessenger::class,
            ],
            'factories' => [
                H1::class                      => InvokableFactory::class,
                Date::class                    => InvokableFactory::class,
                BootstrapForm::class           => InvokableFactory::class,
                BootstrapMenu::class           => InvokableFactory::class,
                BootstrapFlashMessenger::class =>
                    BootstrapFlashMessengerFactory::class,
            ],
        ];
    }

    /**
     * Get view manager configuration
     *
     * @return array
     */
    public function getViewManagerConfig()
    {
        return [
            'template_path_stack' => [__DIR__ . '/../view',],
            'template_map'        =>
                include __DIR__ . '/../template_map.php',
        ];
    }

    /**
     * Get templates configuration for expressive
     *
     * @return array
     */
    public function getTemplatesConfig()
    {
        return [
            'map'   => [
                'travello-view-helper/widget/bootstrap-alert'              =>
                    __DIR__ . '/../view/travello-view-helper/widget/bootstrap-alert',
                'travello-view-helper/widget/bootstrap-form-checkbox'      =>
                    __DIR__ . '/../view/travello-view-helper/widget/bootstrap-form-checkbox.phtml',
                'travello-view-helper/widget/bootstrap-form-group'         =>
                    __DIR__ . '/../view/travello-view-helper/widget/bootstrap-form-group.phtml',
                'travello-view-helper/widget/bootstrap-form-group-inline'  =>
                    __DIR__ . '/../view/travello-view-helper/widget/bootstrap-form-group-inline.phtml',
                'travello-view-helper/widget/bootstrap-form-static'        =>
                    __DIR__ . '/../view/travello-view-helper/widget/bootstrap-form-static',
                'travello-view-helper/widget/bootstrap-form-submit'        =>
                    __DIR__ . '/../view/travello-view-helper/widget/bootstrap-form-submit.phtml',
                'travello-view-helper/widget/bootstrap-form-submit-inline' =>
                    __DIR__ . '/../view/travello-view-helper/widget/bootstrap-form-submit-inline.phtml',
            ],
        ];
    }
}
