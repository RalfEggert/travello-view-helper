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

use Zend\Form\Element\Button;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\File;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;
use Zend\Form\Form;
use Zend\Form\FormInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

/**
 * Class BootstrapForm
 *
 * Render a form in Twitter Bootstrap style
 *
 * @package TravelloViewHelper\View\Helper
 */
class BootstrapForm extends AbstractHelper
{
    /**
     * Outputs message depending on flag
     *
     * @param FormInterface $form
     * @param array         $staticElements
     * @param null          $formClass
     *
     * @return string
     */
    public function __invoke(
        FormInterface $form, array $staticElements = [], $formClass = null
    ) {
        $submitElements = [];

        /** @var Form $form */
        $form->setAttribute('role', 'form');

        if ($formClass == 'form-inline') {
            $form->setAttribute('class', $formClass . ' pull-right');
        } elseif ($formClass) {
            $form->setAttribute('class', $formClass);
        } else {
            $formClass = $form->getAttribute('class');
        }

        $form->prepare();

        $output = $this->getView()->form()->openTag($form);

        foreach ($staticElements as $element) {
            $viewModel = new ViewModel();
            $viewModel->setVariable('label', $element['label']);
            $viewModel->setVariable('value', $element['value']);
            $viewModel->setTemplate(
                'travello-view-helper/widget/bootstrap-form-static'
            );

            $output .= $this->getView()->render($viewModel);
        }

        foreach ($form as $element) {
            if ($element instanceof Submit || $element instanceof Button) {
                $submitElements[] = $element;
            } elseif (
                $element instanceof Csrf || $element instanceof Hidden
            ) {
                $output .= $this->getView()->formElement($element);
            } elseif ($element instanceof Checkbox) {
                $viewModel = new ViewModel();
                $viewModel->setVariable('element', $element);
                $viewModel->setTemplate(
                    'travello-view-helper/widget/bootstrap-form-checkbox'
                );

                $output .= $this->getView()->render($viewModel);
            } else {
                if ($element instanceof File) {
                    $element->setAttributes(
                        ['class' => 'form-control-static']
                    );
                } else {
                    $element->setAttributes(['class' => 'form-control']);
                }

                if ($formClass == 'form-inline') {
                    $element->setLabelAttributes(
                        ['class' => 'control-label']
                    );

                    $template = 'bootstrap-form-group-inline';
                } else {
                    $element->setLabelAttributes(
                        ['class' => 'col-sm-2 control-label']
                    );

                    $template = 'bootstrap-form-group';
                }

                $viewModel = new ViewModel();
                $viewModel->setVariable('element', $element);
                $viewModel->setTemplate(
                    'travello-view-helper/widget/' . $template
                );

                $output .= $this->getView()->render($viewModel);
            }
        }

        if ($formClass == 'form-inline') {
            $template = 'bootstrap-form-submit-inline';
        } else {
            $template = 'bootstrap-form-submit';
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('submitElements', $submitElements);
        $viewModel->setTemplate(
            'travello-view-helper/widget/' . $template
        );

        $output .= $this->getView()->render($viewModel);

        $output .= $this->getView()->form()->closeTag();

        return $output;
    }
}
