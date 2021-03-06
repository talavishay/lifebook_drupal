<?php

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Project entities.
 */
class ProjectViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['project']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Project'),
      'help' => $this->t('The Project ID.'),
    );

    return $data;
  }

}
