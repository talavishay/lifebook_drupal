<?php

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Chapters entities.
 */
class ChaptersViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['chapters']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Chapters'),
      'help' => $this->t('The Chapters ID.'),
    );

    return $data;
  }

}
