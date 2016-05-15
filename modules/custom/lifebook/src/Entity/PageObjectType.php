<?php

namespace Drupal\lifebook\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\lifebook\PageObjectTypeInterface;

/**
 * Defines the Page object type entity.
 *
 * @ConfigEntityType(
 *   id = "page_object_type",
 *   label = @Translation("Page object type"),
 *   handlers = {
 *     "list_builder" = "Drupal\lifebook\PageObjectTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\lifebook\Form\PageObjectTypeForm",
 *       "edit" = "Drupal\lifebook\Form\PageObjectTypeForm",
 *       "delete" = "Drupal\lifebook\Form\PageObjectTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\lifebook\PageObjectTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "page_object_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "page_object",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/lifebook/admin/page_object_type/{page_object_type}",
 *     "add-form" = "/lifebook/admin/page_object_type/add",
 *     "edit-form" = "/lifebook/admin/page_object_type/{page_object_type}/edit",
 *     "delete-form" = "/lifebook/admin/page_object_type/{page_object_type}/delete",
 *     "collection" = "/lifebook/admin/page_object_type"
 *   }
 * )
 */
class PageObjectType extends ConfigEntityBundleBase implements PageObjectTypeInterface {

  /**
   * The Page object type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Page object type label.
   *
   * @var string
   */
  protected $label;

}
