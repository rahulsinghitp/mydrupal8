<?php

namespace Drupal\module_hero\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Our custom hero form
 */
class AjaxHeroForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return "module_hero_ajaxform";
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['message'] = [
            '#type' => 'markup',
            '#markup' => '<div class="result-message"></div>',
        ];

        for($i = 1; $i <= 2;$i++) {
            $form['rival_' . $i] = [
                '#type' => 'textfield',
                '#title' => $this->t('Rival ' . $i),
            ];
        }

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Who will win'),
            '#ajax' => [
                'callback' => '::setMessage',
            ],

        ];

        return $form;
    }

    /**
     * Ajax callback
     */
    public function setMessage(array $form, FormStateInterface $form_state) {
        $winner = rand(1, 2);
        $response = new AjaxResponse();
        $response->addCommand(
            new HtmlCommand(
                '.result-message',
                'The Winner is ' . $form_state->getValue('rival_' . $winner)
            )
        );

        return $response;

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
    }

}