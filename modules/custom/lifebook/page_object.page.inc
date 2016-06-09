<?php

/**
 * @file
 * Contains page_object.page.inc.
 *
 * Page callback for Page object entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Page object templates.
 *
 * Default template: page_object.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_page_object(array &$variables) {
  // Fetch PageObject Entity Object.
  $page_object = $variables['elements']['#page_object'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
  //~ $variables['#attached']['library'][] = 'lifebook/lifebookStudentApp';
  //
  $variables['#attached']['library'][] = 'lifebook/lifebookStudentApp';
    $variables['#attached']['drupalSettings']['lifebookStudentApp'] = array(
       $page_object->uuid() => json_decode(\Drupal::service('serializer')->serialize($page_object, 'json'))
    );
}

/**
* Prepares variables for a custom entity type creation list templates.
*
* Default template: page_object-content-add-list.html.twig.
*
* @param array $variables
*   An associative array containing:
*   - content: An array of page_object-types.
*
* @see block_content_add_page()
*/
function template_preprocess_page_object_content_add_list(&$variables) {
  $variables['types'] = array();
  $query = \Drupal::request()->query->all();
  foreach ($variables['content'] as $type) {
    $variables['types'][$type->id()] = array(
      'link' => Link::fromTextAndUrl($type->label(), new Url('entity.page_object.add_form', array(
        'page_object_type' => $type->id()
      ), array('query' => $query))),
      'description' => array(
      '#markup' => $type->label(),
      ),
      'title' => $type->label(),
      'localized_options' => array(
      'query' => $query,
      ),
    );
  }
}
