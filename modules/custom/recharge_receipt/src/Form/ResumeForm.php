<?php

/**
 *
 */

namespace Drupal\recharge_receipt\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ResumeForm extends FormBase {
    /**
     * @inherit doc
    */

    public function getformId() {
        return 'resume form';
    }

    /**
   * {@inheritdoc}
   */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['candidate_name'] = array(
            '#type' => 'textfield',
            '#title' => t('Candidate Name:'),
            '#required' => TRUE,
        );
        $form['candidate_mail'] = array(
            '#type' => 'email',
            '#title' => t('Email ID:'),
            '#required' => TRUE,
        );
        $form['candidate_number'] = array (
            '#type' => 'tel',
            '#title' => t('Mobile no'),
        );
        $form['candidate_dob'] = array (
            '#type' => 'date',
            '#title' => t('DOB'),
            '#required' => TRUE,
        );
        $form['candidate_gender'] = array (
            '#type' => 'select',
            '#title' => ('Gender'),
            '#options' => array(
                'female' => t('Female'),
                'male' => t('Male'),
            ),
        );
        $form['candidate_confirmation'] = array (
            '#type' => 'radios',
            '#title' => ('Are you above 18 years old?'),
            '#options' => array(
                true => t('Yes'),
                false => t('No')
            ),
        );
        $form['candidate_copy'] = array(
            '#type' => 'checkbox',
            '#title' => t('Send me a copy of the application.'),
        );
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Save'),
            '#button_type' => 'primary',
        );
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

        if (strlen($form_state->getValue('candidate_number')) < 10) {
            $form_state->setErrorByName('candidate_number', $this->t('Mobile number is too short.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $values = $form_state->getValues();
        $connection = \Drupal\Core\Database\Database::getConnection();
        $result = $connection->insert('candidate_registration')
            ->fields(['candidate_name', 'candidate_email', 'candidate_mob_no', 'candidate_dob', 'candidate_gender', 'candidate_above_18', 'candidate_send_copy_application'])
            ->values([
                'candidate_name' => $values['candidate_name'],
                'candidate_email' => $values['candidate_mail'],
                'candidate_mob_no' => $values['candidate_number'],
                'candidate_dob' => date('Y-m-d', strtotime($values['candidate_dob'])),
                'candidate_gender' => $values['candidate_gender'],
                'candidate_above_18' => !empty($values['candidate_confirmation']) ? 1 : 0,
                'candidate_send_copy_application' => !empty($values['candidate_copy']) ? 1 : 0,
            ])
            ->execute();
    }
}