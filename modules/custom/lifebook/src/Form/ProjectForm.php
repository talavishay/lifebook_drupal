<?php

namespace Drupal\lifebook\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Project edit forms.
 *
 * @ingroup lifebook
 */
class ProjectForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\lifebook\Entity\Project */
    $form = parent::buildForm($form, $form_state);
    $form["test"] = array(
		'#markup' => '<em>This is filtered using the admin tag list</em>',
    );
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Project.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Project.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.project.canonical', ['project' => $entity->id()]);
  }

}
