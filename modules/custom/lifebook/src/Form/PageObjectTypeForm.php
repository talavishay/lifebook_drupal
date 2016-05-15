<?php

namespace Drupal\lifebook\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PageObjectTypeForm.
 *
 * @package Drupal\lifebook\Form
 */
class PageObjectTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $page_object_type = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $page_object_type->label(),
      '#description' => $this->t("Label for the Page object type."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $page_object_type->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\lifebook\Entity\PageObjectType::load',
      ),
      '#disabled' => !$page_object_type->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $page_object_type = $this->entity;
    $status = $page_object_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Page object type.', [
          '%label' => $page_object_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Page object type.', [
          '%label' => $page_object_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($page_object_type->urlInfo('collection'));
  }

}
