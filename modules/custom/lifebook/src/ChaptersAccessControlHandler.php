<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Chapters entity.
 *
 * @see \Drupal\lifebook\Entity\Chapters.
 */
class ChaptersAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lifebook\ChaptersInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished chapters entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published chapters entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit chapters entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete chapters entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add chapters entities');
  }

}
