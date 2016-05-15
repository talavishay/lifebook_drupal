<?php

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Page object entities.
 */
class PageObjectViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['page_object']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Page object'),
      'help' => $this->t('The Page object ID.'),
    );

    return $data;
  }

}
