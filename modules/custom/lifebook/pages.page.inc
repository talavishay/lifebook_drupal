<?php

/**
 * @file
 * Contains pages.page.inc.
 *
 * Page callback for Pages entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Pages templates.
 *
 * Default template: pages.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_pages(array &$variables) {
  // Fetch Pages Entity Object.
  $pages = $variables['elements']['#pages'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
