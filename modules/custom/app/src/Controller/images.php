<?php
/**
 * @file
 * Contains \Drupal\app\Controller\images.
 */
namespace Drupal\app\Controller;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
/** * Defines a controller to respond to  image requests . */
class images {
  /** @param string $entity
   *   The unique id    */
  public function getById($entity) {
	$file = file_load($entity);
	
	//~ $out =  $file->getFileUri();
	$image_uri = ImageStyle::load('your_style-name')->buildUrl($file->getFileUri());
	die();
	
  }
  /** @param string $entity
   *   The unique uuid    */
  public function getByUUid($entity) {
	$file = \Drupal::entityManager()->loadEntityByUuid('file', $entity);
	if($file){	
		$uri =  $file->getFileUri();
		header('Content-Type: '.$file->getMimeType());
		//~ readfile($uri);
			
		$headers = array(
		  'Content-Type' => $file->getMimeType(),
		  'Content-Length' => $file->getSize(),
		);
		// \Drupal\Core\EventSubscriber\FinishResponseSubscriber::onRespond()
		// sets response as not cacheable if the Cache-Control header is not
		// already modified. We pass in FALSE for non-private schemes for the
		// $public parameter to make sure we don't change the headers.
		return new BinaryFileResponse($uri, 200, $headers, $scheme !== 'private');
			//~ exit();
	};
    //~             return new BinaryFileResponse($uri, 200, $headers, $scheme !== 'private');
  }
}
