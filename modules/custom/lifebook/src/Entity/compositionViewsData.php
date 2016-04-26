<?php

/**
 * @file
 * Contains \Drupal\lifebook\Entity\composition.
 */

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Composition entities.
 */
class compositionViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['composition']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Composition'),
      'help' => $this->t('The Composition ID.'),
    );

    return $data;
  }

}
