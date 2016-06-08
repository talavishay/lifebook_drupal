<?php
//TODO:  NO ACL ! maybe move to a "resource"/REST
/**
 * @file
 * Contains \Drupal\app\Controller\upload.
 */
namespace Drupal\app\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
class upload {

  /**
   * Returns saved entity info status for a file upload process.
   * @param string $key
   *   The unique key -fid for this upload.
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JsonResponse object.
   */
  public function post($key) {
  	$file = file_get_contents('php://input');
  	$fileEntity = file_load($key);
  	if(!$fileEntity ){
      $fileEntity = file_save_data( $file);//file_save_data --> saves data to disk? & assign it to a new file enitity 	
  	} else {
  		file_put_contents($fileEntity->getFileUri(), $file);
  	};
  	$fileEntity->setMimeType("image/png");
  	$fileEntity->setFilename($fileEntity->getFilename().".png");
  	
  	 
	//TODO: is this nesscesry on new file?
    $fileEntity->save();
  
    
     //~ $_file = \Drupal\file\Entity\File::load($file->id());
    if($fileEntity){
      $body = json_decode(\Drupal::service('serializer')
                      ->serialize($fileEntity, 'json'));
      $body->url = $fileEntity->url();
      $body->created = \Drupal::service('date.formatter')
                    ->format($fileEntity->getCreatedTime(), 'date_text');
      
      return new JsonResponse($body);
      //~ return new JsonResponse(array(
        //~ "fid" => $fileEntity->id(),
        //~ "uuid" => $fileEntity->uuid(),
        //~ "name" => $fileEntity->getFilename(),
        //~ "uri" => $fileEntity->getFileUri(),
      //~ ));   
    } else {
      $arr = get_defined_functions();
      return new JsonResponse($arr);
    };
  }
}
