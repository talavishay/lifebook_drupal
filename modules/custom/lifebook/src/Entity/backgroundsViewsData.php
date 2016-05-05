<?php

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Backgrounds entities.
 */
class backgroundsViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['backgrounds']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Backgrounds'),
      'help' => $this->t('The Backgrounds ID.'),
    );

    return $data;
  }

}
