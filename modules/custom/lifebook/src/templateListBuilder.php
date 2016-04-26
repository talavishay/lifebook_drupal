<?php

/**
 * @file
 * Contains \Drupal\lifebook\templateListBuilder.
 */

namespace Drupal\lifebook;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Template entities.
 *
 * @ingroup lifebook
 */
class templateListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Template ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\lifebook\Entity\template */
    $row['id'] = $entity->id();
    //~ $row['type'] = $entity->type;
    //~ $row['category'] = $entity->category;
    //~ $row['pageType'] = $entity->pageType;
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.template.edit_form', array(
          'template' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
