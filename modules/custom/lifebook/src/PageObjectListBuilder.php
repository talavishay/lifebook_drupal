<?php

namespace Drupal\lifebook;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Page object entities.
 *
 * @ingroup lifebook
 */
class PageObjectListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    $header['lastName'] = $this->t('Last name');
    //~ $header['view'] = $this->t('View');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity,         $_page_object) {
    /* @var $entity \Drupal\lifebook\Entity\PageObject */
    //~ $row['id'] = $_page_object->id[0]->value;
    
    $row['name'] =  $_page_object->name[0]->value;
    $row['lastName'] =  $_page_object->field_last_name[0]->value;
    //~ $row['view'] = $this->l(
      //~ "view",
      //~ new Url(
        //~ 'entity.page_object.canonical', array(
          //~ 'page_object' => $_page_object->id[0]->value,
        //~ )
      //~ )
    //~ );
    //~ $row["nameE"] = [
              //~ 'data-uuid' => $entity->uuid(),
             
              //~ 'style'     => "display:none"
    //~ ];
    
    return $row + parent::buildRow($entity);
  }
  
  /**
   * {@inheritdoc}
   *
   * Builds the entity listing as renderable array for table.html.twig.
   *
   * @todo Add a link to add a new item to the #empty text.
   */
  public function render() {
    $build['#attached']['drupalSettings']['lifebookStudentApp'] = [];
    $build['table'] = array(
      '#type' => 'table',
      '#header' => $this->buildHeader(),
      '#title' => $this->getTitle(),
      '#rows' => array(),
      '#empty' => $this->t('There is no @label yet.', array('@label' => $this->entityType->getLabel())),
      '#cache' => [
        'contexts' => $this->entityType->getListCacheContexts(),
        'tags' => $this->entityType->getListCacheTags(),
      ],
    );
    
    foreach ($this->load() as $page_object) {
        $_page_object = $page_object->getJson();
      if ($row = $this->buildRow($page_object,        $_page_object)) {
        //~ $build['table']['#rows'][$page_object->id()] = $row;
          $build['table']['#rows'][$page_object->id()]['data'] =  $row;
          //~ [
                //~ json_encode($_page_object),
                //~ 0 => $page_object->getName(),
                //~ 1 => $_page_object->field_personal_picture[0]->url,
                //~ 2 => $_page_object->field_last_name[0]->value,
          //~ ];
          $build['table']['#rows'][$page_object->id()]['data-uuid'] = $page_object->uuid();
           //~ [
                  //~ 'data-uuid' => $page_object->uuid()
                //~ ] =  [

        
        $build['#attached']['drupalSettings']['lifebookStudentApp'][] = 
        [  $page_object->uuid() =>   $_page_object ];
      }
    }

    // Only add the pager if a limit is specified.
    if ($this->limit) {
      $build['pager'] = array(
        '#type' => 'pager',
      );
    }
    $build['#attached']['library'][] = 'lifebook/lifebookStudentApp';
    $build["x"] = [  "#markup" => '<h1>lifebookStudentApp</h1>'  ];
    return $build;
  }
  
  
  /**
   * Gets this list's default operations.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity the operations are for.
   *
   * @return array
   *   The array structure is identical to the return value of
   *   self::getOperations().
   */
  protected function getDefaultOperations(EntityInterface $entity) {
    $operations = array();
    if ($entity->access('update') && $entity->hasLinkTemplate('edit-form')) {
      $operations['edit'] = array(
        'title' => $this->t('Edit'),
        'weight' => 10,
        'url' => $entity->urlInfo('edit-form'),
      );
    }
    if ($entity->access('delete') && $entity->hasLinkTemplate('delete-form')) {
      $operations['delete'] = array(
        'title' => $this->t('Delete'),
        'weight' => 100,
        'url' => $entity->urlInfo('delete-form'),
      );
    }

    if ($entity->access('view')) {
      $operations['view'] = array(
        'title' => $this->t('View'),
        'weight' => 0,
        'url' =>  new Url(
          'entity.page_object.canonical', array(
            'page_object' => $entity->id(),
          )
        ),
      );
    }

    return $operations;
  }


}
