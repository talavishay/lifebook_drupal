<?php

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Pages entities.
 */
class PagesViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['pages']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Pages'),
      'help' => $this->t('The Pages ID.'),
    );

    return $data;
  }

}
