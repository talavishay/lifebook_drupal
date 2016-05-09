<?php

namespace Drupal\lifebook\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\lifebook\BookTypeInterface;

/**
 * Defines the Book type entity.
 *
 * @ConfigEntityType(
 *   id = "book_type",
 *   label = @Translation("Book type"),
 *   handlers = {
 *     "list_builder" = "Drupal\lifebook\BookTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\lifebook\Form\BookTypeForm",
 *       "edit" = "Drupal\lifebook\Form\BookTypeForm",
 *       "delete" = "Drupal\lifebook\Form\BookTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\lifebook\BookTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "book_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "book",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/lifebook/admin/book_type/{book_type}",
 *     "add-form" = "/lifebook/admin/book_type/add",
 *     "edit-form" = "/lifebook/admin/book_type/{book_type}/edit",
 *     "delete-form" = "/lifebook/admin/book_type/{book_type}/delete",
 *     "collection" = "/lifebook/admin/book_type"
 *   }
 * )
 */
class BookType extends ConfigEntityBundleBase implements BookTypeInterface {

  /**
   * The Book type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Book type label.
   *
   * @var string
   */
  protected $label;

}
