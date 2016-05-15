<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Page object entity.
 *
 * @see \Drupal\lifebook\Entity\PageObject.
 */
class PageObjectAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lifebook\PageObjectInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished page object entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published page object entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit page object entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete page object entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add page object entities');
  }

}
