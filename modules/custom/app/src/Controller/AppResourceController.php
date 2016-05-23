<?php

namespace Drupal\app\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class AppResourceController.
 *
 * @package Drupal\app\Controller
 */
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\lifebook\Entity\PageObject;
use Drupal\lifebook\Entity\Chapters;
use Drupal\lifebook\Entity\Pages;
use Drupal\lifebook\Entity\Composition;

class AppResourceController extends ControllerBase {
	
  /**
   * get Chapter resources .
   *
   
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JsonResponse object.
   */
  public function chapter($chapterId) {
  	$Chapter = Chapters::load($chapterId);
    return new JsonResponse($Chapter->getResources()); 
  }

}
