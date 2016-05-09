<?php

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Book entities.
 */
class BookViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['book']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Book'),
      'help' => $this->t('The Book ID.'),
    );

    return $data;
  }

}
