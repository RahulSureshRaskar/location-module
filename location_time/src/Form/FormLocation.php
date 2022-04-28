<?php

namespace Drupal\location_time\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class FormLocation.
 */
class FormLocation extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'location_time.formlocation',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_location';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('location_time.formlocation');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Enter Country Name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#description' => $this->t('Enter City Name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('city'),
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#description' => $this->t('Choose Timezone'),
      '#options' => ['America/Chicago'=>'America/Chicago','America/New_York'=>'America/New_York','Asia/Tokyo'=>'Asia/Tokyo','Asia/Dubai'=>'Asia/Dubai','Asia/Kolkata'=>'Asia/Kolkata','Europe/Amsterdam'=>'Europe/Amsterdam','Europe/Oslo'=>'Europe/Oslo','Europe/London'=>'Europe/London'],
      '#default_value' => $config->get('timezone'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('location_time.formlocation')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}
