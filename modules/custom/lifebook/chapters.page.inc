<?php

/**
 * @file
 * Contains chapters.page.inc.
 *
 * Page callback for Chapters entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Chapters templates.
 *
 * Default template: chapters.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_chapters(array &$variables) {
  // Fetch Chapters Entity Object.
  $chapters = $variables['elements']['#chapters'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
