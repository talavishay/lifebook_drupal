<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Book entities.
 *
 * @ingroup lifebook
 */
interface BookInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Book type.
   *
   * @return string
   *   The Book type.
   */
  public function getType();

  /**
   * Gets the Book name.
   *
   * @return string
   *   Name of the Book.
   */
  public function getName();

  /**
   * Sets the Book name.
   *
   * @param string $name
   *   The Book name.
   *
   * @return \Drupal\lifebook\BookInterface
   *   The called Book entity.
   */
  public function setName($name);

  /**
   * Gets the Book creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Book.
   */
  public function getCreatedTime();

  /**
   * Sets the Book creation timestamp.
   *
   * @param int $timestamp
   *   The Book creation timestamp.
   *
   * @return \Drupal\lifebook\BookInterface
   *   The called Book entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Book published status indicator.
   *
   * Unpublished Book are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Book is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Book.
   *
   * @param bool $published
   *   TRUE to set this Book to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lifebook\BookInterface
   *   The called Book entity.
   */
  public function setPublished($published);

}
