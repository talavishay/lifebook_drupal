<?php

namespace Drupal\lifebook\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\lifebook\ProjectTypeInterface;

/**
 * Defines the Project type entity.
 *
 * @ConfigEntityType(
 *   id = "project_type",
 *   label = @Translation("Project type"),
 *   handlers = {
 *     "list_builder" = "Drupal\lifebook\ProjectTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\lifebook\Form\ProjectTypeForm",
 *       "edit" = "Drupal\lifebook\Form\ProjectTypeForm",
 *       "delete" = "Drupal\lifebook\Form\ProjectTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\lifebook\ProjectTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "project_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "project",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/lifebook/admin/project_type/add",
 *     "edit-form" = "/lifebook/admin/project_type/{project_type}/edit",
 *     "delete-form" = "/lifebook/admin/project_type/{project_type}/delete",
 *     "collection" = "/lifebook/admin/project_type"
 *   }
 * )
 */
class ProjectType extends ConfigEntityBundleBase implements ProjectTypeInterface {

  /**
   * The Project type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Project type label.
   *
   * @var string
   */
  protected $label;

}
