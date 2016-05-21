<?php

namespace Drupal\lifebook\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class DeleteAllprojects.
 *
 * @package Drupal\lifebook\Controller
 */
class DeleteAllprojects extends ControllerBase {

  /**
   * Doit.
   *
   * @return string
   *   Return Hello string.
   */
  public function doit() {
  	$query = \Drupal::entityQuery('page_object');
  	$ids = $query->execute();
  	if(count($ids)){
	  	$entities = \Drupal::entityTypeManager()
	  		->getStorage('page_object')
	  		->loadMultiple($ids);
		
		$entity_storage = \Drupal::entityTypeManager()
				->getStorage('page_object')
				->delete($entities );
  	};
  	
	$query = \Drupal::entityQuery('pages');
	$pageids = $query->execute();
	if(count($pageids )){
		$pages = \Drupal::entityTypeManager()
		->getStorage('pages')
		->loadMultiple($pageids);
		
		$entity_storage = \Drupal::entityTypeManager()
		->getStorage('pages')
		->delete($pages );
	 };
	
	$query = \Drupal::entityQuery('composition');
	$compositionids = $query->execute();
	if(count($compositionids )){
		$compositions = \Drupal::entityTypeManager()
		->getStorage('composition')
		->loadMultiple($compositionids);
		
		$entity_storage = \Drupal::entityTypeManager()
		->getStorage('composition')
		->delete($compositions );
	};	
	
	$query = \Drupal::entityQuery('chapters');
	$chaptersids = $query->execute();
	if(count($chaptersids)){
		$chapters = \Drupal::entityTypeManager()
		->getStorage('chapters')
		->loadMultiple($chaptersids );
		
		$entity_storage = \Drupal::entityTypeManager()
		->getStorage('chapters')
		->delete($chapters );
	};
	
	
	$query = \Drupal::entityQuery('project');
	$projectids = $query->execute();
	if(count($projectids )){
		$projects = \Drupal::entityTypeManager()
		->getStorage('project')
		->loadMultiple($projectids);
		
		$entity_storage = \Drupal::entityTypeManager()
		->getStorage('project')
		->delete($projects );
  	};
	
    return [
      '#type' => 'markup',
      '#markup' => $this->t('deleted all page objects : '. implode(", ", $ids))
    ];
  }

}
