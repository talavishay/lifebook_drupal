<?php

/**
 * @file
 * Contains \Drupal\lifebook\compositionInterface.
 */

namespace Drupal\lifebook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Composition entities.
 *
 * @ingroup lifebook
 */
interface compositionInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Composition name.
   *
   * @return string
   *   Name of the Composition.
   */
  public function getName();

  /**
   * Sets the Composition name.
   *
   * @param string $name
   *   The Composition name.
   *
   * @return \Drupal\lifebook\compositionInterface
   *   The called Composition entity.
   */
  public function setName($name);

  /**
   * Gets the Composition creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Composition.
   */
  public function getCreatedTime();

  /**
   * Sets the Composition creation timestamp.
   *
   * @param int $timestamp
   *   The Composition creation timestamp.
   *
   * @return \Drupal\lifebook\compositionInterface
   *   The called Composition entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Composition published status indicator.
   *
   * Unpublished Composition are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Composition is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Composition.
   *
   * @param bool $published
   *   TRUE to set this Composition to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lifebook\compositionInterface
   *   The called Composition entity.
   */
  public function setPublished($published);

}
