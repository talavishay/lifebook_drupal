<?php

/**
 * @file
 * Contains \Drupal\lifebook\Entity\template.
 */

namespace Drupal\lifebook\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Template entities.
 */
class templateViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['template']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Template'),
      'help' => $this->t('The Template ID.'),
    );

    return $data;
  }

}
