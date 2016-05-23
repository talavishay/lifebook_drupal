<?php

/**
 * @file
 * Contains \Drupal\app\Plugin\rest\resource\SvgResource.
 */

namespace Drupal\app\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "svg_resource",
 *   label = @Translation("Svg resource"),
 *   uri_paths = {
 *     "canonical" = "/lifebook/clipart/{dir}"
 *   }
 * )
 */
class SvgResource extends ResourceBase {
  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('rest'),
      $container->get('current_user')
    );
  }

	
  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
	public function get($dir = NULL) {
		$_d = explode("_", $dir);
		$root = $_d[0];
		$dir = $_d[1];
		
		$uri = '/var/www/resources/'.$root;
		
		if($dir != "root"){
			$uri = $uri.'/'.$dir;
			if( isset($_d[2]) ){
				$uri = $uri.'/'.$_d[2];
			}
			
		};

		// Throw an exception if it is required.
		return new ResourceResponse($this->_scan($uri));
		//~ return new ResourceResponse($uri);
		throw new HttpException(t('error'));
	}
  /**
   * Responds to GET requests.
   *
   * Returns an array of files & directories.
   *
   */
	public function _getFileContent($path) {
		//~ $path = 'folder/image.png';
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		//~ $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		return array(
			"src" => 'data:image/' . $type . '+xml;base64,' . base64_encode($data),
			"data-extension" => $type,
		);
	}
  /**
   * Responds to GET requests.
   *
   * Returns an array of files & directories.
   *
   */

	public function _scan($uri) {
		$out = array(
			"files" => array(),
			"dirs" => array(),
		);
		foreach (scandir($uri) as $key => $val){
			if($val !== "." && $val !== ".."){
				if(count(explode(".", $val))-1){
					
					$out["files"][] = array("data-name" => $val) + 
						$this->_getFileContent($uri.'/'.$val);
					
				} else {
					$out["dirs"][] = $val;
				}
			}
		};
		return $out;
	
	}
}
