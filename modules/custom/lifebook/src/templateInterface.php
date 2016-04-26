<?php

/**
 * @file
 * Contains \Drupal\lifebook\templateInterface.
 */

namespace Drupal\lifebook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Template entities.
 *
 * @ingroup lifebook
 */
interface templateInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Template name.
   *
   * @return string
   *   Name of the Template.
   */
  public function getName();

  /**
   * Sets the Template name.
   *
   * @param string $name
   *   The Template name.
   *
   * @return \Drupal\lifebook\templateInterface
   *   The called Template entity.
   */
  public function setName($name);

  /**
   * Gets the Template creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Template.
   */
  public function getCreatedTime();

  /**
   * Sets the Template creation timestamp.
   *
   * @param int $timestamp
   *   The Template creation timestamp.
   *
   * @return \Drupal\lifebook\templateInterface
   *   The called Template entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Template published status indicator.
   *
   * Unpublished Template are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Template is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Template.
   *
   * @param bool $published
   *   TRUE to set this Template to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lifebook\templateInterface
   *   The called Template entity.
   */
  public function setPublished($published);

}
