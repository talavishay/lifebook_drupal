<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Pages entity.
 *
 * @see \Drupal\lifebook\Entity\Pages.
 */
class PagesAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lifebook\PagesInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished pages entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published pages entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit pages entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete pages entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add pages entities');
  }

}
