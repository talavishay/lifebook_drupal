<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Backgrounds entities.
 *
 * @ingroup lifebook
 */
interface backgroundsInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Backgrounds name.
   *
   * @return string
   *   Name of the Backgrounds.
   */
  public function getName();

  /**
   * Sets the Backgrounds name.
   *
   * @param string $name
   *   The Backgrounds name.
   *
   * @return \Drupal\lifebook\backgroundsInterface
   *   The called Backgrounds entity.
   */
  public function setName($name);

  /**
   * Gets the Backgrounds creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Backgrounds.
   */
  public function getCreatedTime();

  /**
   * Sets the Backgrounds creation timestamp.
   *
   * @param int $timestamp
   *   The Backgrounds creation timestamp.
   *
   * @return \Drupal\lifebook\backgroundsInterface
   *   The called Backgrounds entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Backgrounds published status indicator.
   *
   * Unpublished Backgrounds are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Backgrounds is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Backgrounds.
   *
   * @param bool $published
   *   TRUE to set this Backgrounds to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lifebook\backgroundsInterface
   *   The called Backgrounds entity.
   */
  public function setPublished($published);

}
