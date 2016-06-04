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

use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger as ZendFlashMessenger;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

/**
 * Class BootstrapFlashMessenger
 *
 * Outputs all messages from FlashMessenger in Bootstrap style
 *
 * @package TravelloViewHelper\View\Helper
 */
class BootstrapFlashMessenger extends AbstractHelper
{
    /**
     * FlashMessenger plugin
     *
     * @var ZendFlashMessenger
     */
    protected $flashMessenger;

    /**
     * Sets FlashMessenger plugin
     *
     * @param  ZendFlashMessenger $flashMessenger
     *
     * @return AbstractHelper
     */
    public function setFlashMessenger(
        ZendFlashMessenger $flashMessenger = null
    ) {
        $this->flashMessenger = $flashMessenger;

        return $this;
    }
    /**
     * Constructor
     *
     * @param  ZendFlashMessenger $flashMessenger
     */
    public function __construct(ZendFlashMessenger $flashMessenger)
    {
        $this->setFlashMessenger($flashMessenger);
    }

    /**
     * Outputs message depending on flag
     *
     * @return string
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * Outputs message depending on flag
     *
     * @return string
     */
    public function render()
    {
        $allMessages = [
            'danger' => array_unique(
                array_merge(
                    $this->flashMessenger->getErrorMessages(),
                    $this->flashMessenger->getCurrentErrorMessages()
                )
            ),
            'success' => array_unique(
                array_merge(
                    $this->flashMessenger->getSuccessMessages(),
                    $this->flashMessenger->getCurrentSuccessMessages()
                )
            ),
            'warning' => array_unique(
                array_merge(
                    $this->flashMessenger->getWarningMessages(),
                    $this->flashMessenger->getCurrentWarningMessages()
                )
            ),
            'info' => array_unique(
                array_merge(
                    $this->flashMessenger->getInfoMessages(),
                    $this->flashMessenger->getCurrentInfoMessages()
                )
            ),
            'default' => array_unique(
                array_merge(
                    $this->flashMessenger->getMessages(),
                    $this->flashMessenger->getCurrentMessages()
                )
            ),
        ];

        $this->flashMessenger->clearMessagesFromContainer();
        $this->flashMessenger->clearCurrentMessagesFromContainer();

        $output = '';

        foreach ($allMessages as $groupKey => $groupMessages) {
            foreach ($groupMessages as $message) {
                $addClass = $groupKey == 'default'
                    ? 'alert-info'
                    : 'alert-' . $groupKey;

                $viewModel = new ViewModel();
                $viewModel->setVariable('alertClass', $addClass);
                $viewModel->setVariable('alertMessage', $message);
                $viewModel->setTemplate(
                    'travello-view-helper/widget/bootstrap-alert'
                );

                $output .= $this->getView()->render($viewModel);
            }
        }

        return $output;
    }
}
