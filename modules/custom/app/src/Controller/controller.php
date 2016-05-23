<?php

/**
 * @file
 * Contains \Drupal\app\Controller\controller.
 */

namespace Drupal\app\Controller;
//~ 
class controller  {
 public function content() {
    return array(
        '#type' => 'html',
        '#markup' => 'Hello, World!',
        '#attached' => array(
        'library' =>  array(
          'core/jquery',
          'app/app'
        ),
		),
    );
  }

}
