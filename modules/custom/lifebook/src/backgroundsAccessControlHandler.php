<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Backgrounds entity.
 *
 * @see \Drupal\lifebook\Entity\backgrounds.
 */
class backgroundsAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lifebook\backgroundsInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished backgrounds entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published backgrounds entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit backgrounds entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete backgrounds entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add backgrounds entities');
  }

}
