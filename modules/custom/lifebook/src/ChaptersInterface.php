<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Chapters entities.
 *
 * @ingroup lifebook
 */
interface ChaptersInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Chapters name.
   *
   * @return string
   *   Name of the Chapters.
   */
  public function getName();

  /**
   * Sets the Chapters name.
   *
   * @param string $name
   *   The Chapters name.
   *
   * @return \Drupal\lifebook\ChaptersInterface
   *   The called Chapters entity.
   */
  public function setName($name);

  /**
   * Gets the Chapters creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Chapters.
   */
  public function getCreatedTime();

  /**
   * Sets the Chapters creation timestamp.
   *
   * @param int $timestamp
   *   The Chapters creation timestamp.
   *
   * @return \Drupal\lifebook\ChaptersInterface
   *   The called Chapters entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Chapters published status indicator.
   *
   * Unpublished Chapters are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Chapters is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Chapters.
   *
   * @param bool $published
   *   TRUE to set this Chapters to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lifebook\ChaptersInterface
   *   The called Chapters entity.
   */
  public function setPublished($published);

}
