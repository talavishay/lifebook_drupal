<?php

/**
 * @file
 * Contains \Drupal\app\Controller\upload.
 */
namespace Drupal\app\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Defines a controller to respond to file widget AJAX requests.
 */
class upload {

  /**
   * Returns the progress status for a file upload process.
   *
   * @param string $key
   *   The unique key for this upload process.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JsonResponse object.
   */
  public function post($key) {
  	$file = file_get_contents('php://input');
  	$fileEntity = file_load($key);
  	if(!$fileEntity ){
	  	//file_save_data --> saves data to disk? & assign it to a new file enitity 	
		$fileEntity = file_save_data( $file);
		
  	} else {
  		
  		file_put_contents($fileEntity->getFileUri(), $file);
  	};
	
	//TODO: is this nesscesry on new file?
	$fileEntity->save();
   
   //~ $_file = \Drupal\file\Entity\File::load($file->id());
   
	if($fileEntity){
		return new JsonResponse(array(
			"fid" => $fileEntity->id(),
			"uuid" => $fileEntity->uuid(),
			"name" => $fileEntity->getFilename(),
			"uri" => $fileEntity->getFileUri(),
		));   
	} else {
		$arr = get_defined_functions();
		return new JsonResponse($arr);
   };
  }

}
