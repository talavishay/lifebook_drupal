<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Page object entities.
 *
 * @ingroup lifebook
 */
interface PageObjectInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Page object type.
   *
   * @return string
   *   The Page object type.
   */
  public function getType();

  /**
   * Gets the Page object name.
   *
   * @return string
   *   Name of the Page object.
   */
  public function getName();

  /**
   * Sets the Page object name.
   *
   * @param string $name
   *   The Page object name.
   *
   * @return \Drupal\lifebook\PageObjectInterface
   *   The called Page object entity.
   */
  public function setName($name);

  /**
   * Gets the Page object creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Page object.
   */
  public function getCreatedTime();

  /**
   * Sets the Page object creation timestamp.
   *
   * @param int $timestamp
   *   The Page object creation timestamp.
   *
   * @return \Drupal\lifebook\PageObjectInterface
   *   The called Page object entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Page object published status indicator.
   *
   * Unpublished Page object are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Page object is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Page object.
   *
   * @param bool $published
   *   TRUE to set this Page object to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lifebook\PageObjectInterface
   *   The called Page object entity.
   */
  public function setPublished($published);

}
