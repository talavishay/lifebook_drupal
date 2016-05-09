<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Pages entities.
 *
 * @ingroup lifebook
 */
interface PagesInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Pages name.
   *
   * @return string
   *   Name of the Pages.
   */
  public function getName();

  /**
   * Sets the Pages name.
   *
   * @param string $name
   *   The Pages name.
   *
   * @return \Drupal\lifebook\PagesInterface
   *   The called Pages entity.
   */
  public function setName($name);

  /**
   * Gets the Pages creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Pages.
   */
  public function getCreatedTime();

  /**
   * Sets the Pages creation timestamp.
   *
   * @param int $timestamp
   *   The Pages creation timestamp.
   *
   * @return \Drupal\lifebook\PagesInterface
   *   The called Pages entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Pages published status indicator.
   *
   * Unpublished Pages are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Pages is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Pages.
   *
   * @param bool $published
   *   TRUE to set this Pages to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lifebook\PagesInterface
   *   The called Pages entity.
   */
  public function setPublished($published);

}
