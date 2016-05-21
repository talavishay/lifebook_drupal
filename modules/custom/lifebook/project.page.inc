<?php

/**
 * @file
 * Contains project.page.inc.
 *
 * Page callback for Project entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\Serializer\SerializerInterface;
/**
 * Prepares variables for Project templates.
 *
 * Default template: project.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_project(array &$variables) {
  // Fetch Project Entity Object.
  $project = $variables['elements']['#project'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  };
	$variables['content']['created'] = array(
  		'#markup' => \Drupal::service('date.formatter')->format($project->getCreatedTime(), 'date_text')
	);
  
   $variables['#attached']['library'][] = 'lifebook/lifebookProjectApp';
// 	$output = \Drupal::service('serializer')->serialize($project, FORMAT);

//       $output = $serializer->serialize($project, 'json');
   $variables['#attached']['drupalSettings']['lifebookProjectApp'] = array(
   		'classes'	=> $project->getChapters(),
   		'students'	=> $project->getStudents(),
		'name'		=> $project->getName(),
		'id'		=> $project->id(),
   );
   //~ $variables['#attached']['drupalSettings']['lifebookProjectApp'][] = "XXX";
}

/**
* Prepares variables for a custom entity type creation list templates.
*
* Default template: project-content-add-list.html.twig.
*
* @param array $variables
*   An associative array containing:
*   - content: An array of project-types.
*
* @see block_content_add_page()
*/
function template_preprocess_project_content_add_list(&$variables) {
  $variables['types'] = array();
  $query = \Drupal::request()->query->all();
  foreach ($variables['content'] as $type) {
    $variables['types'][$type->id()] = array(
      'link' => Link::fromTextAndUrl($type->label(), new Url('entity.project.add_form', array(
        'project_type' => $type->id()
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
