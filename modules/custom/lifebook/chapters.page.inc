<?php

/**
 * @file
 * Contains chapters.page.inc.
 *
 * Page callback for Chapters entities.
 */

// use Drupal;

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\lifebook\Entity\PageObject;
use Drupal\lifebook\Entity\Project;

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
  $ids = $chapters->getPageObject();
  $pageObjects = PageObject::loadMultiple($ids);
  $out = "<ul>";
  foreach($pageObjects  as $val){
  	$out .= '<li><a href="/lifebook/page_object/'.$val->id().'"/>'.$val->getName().'</a></li>';	
  }
  $out .= "</ul>";
  $projectIds = Project::loadMultiple($chapters->getProject());
  $project = array_pop($projectIds);
  
  
  $variables['content']["test"] =   array(
  		'#markup' => '<b>students :</b><br/>'.
  		$out.'<br/>'.
  		'<b>project :</b><br/> '.
  		'<a href="/lifebook/project/'.$project->id().'" >'.
  		'ID : '.$project->id().' | '.$project->getName().'</a>'
  );
  
}
