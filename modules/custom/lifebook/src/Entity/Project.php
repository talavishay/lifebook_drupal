<?php

namespace Drupal\lifebook\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\lifebook\ProjectInterface;
use Drupal\user\UserInterface;
use Drupal\lifebook\Entity\PageObject;
/**
 * Defines the Project entity.
 *
 * @ingroup lifebook
 *
 * @ContentEntityType(
 *   id = "project",
 *   label = @Translation("Project"),
 *   bundle_label = @Translation("Project type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lifebook\ProjectListBuilder",
 *     "views_data" = "Drupal\lifebook\Entity\ProjectViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\lifebook\Form\ProjectForm",
 *       "add" = "Drupal\lifebook\Form\ProjectForm",
 *       "edit" = "Drupal\lifebook\Form\ProjectForm",
 *       "delete" = "Drupal\lifebook\Form\ProjectDeleteForm",
 *     },
 *     "access" = "Drupal\lifebook\ProjectAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\lifebook\ProjectHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "project",
 *   admin_permission = "administer project entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/lifebook/project/{project}",
 *     "add-form" = "/lifebook/project/add/{project_type}",
 *     "edit-form" = "/lifebook/project/{project}/edit",
 *     "delete-form" = "/lifebook/project/{project}/delete",
 *     "collection" = "/lifebook/project",
 *   },
 *   bundle_entity_type = "project_type",
 *   field_ui_base_route = "entity.project_type.edit_form"
 * )
 */
class Project extends ContentEntityBase implements ProjectInterface {

  use EntityChangedTrait;

  
  /**
   * {@inheritdoc}
   */
  public static function preDelete(EntityStorageInterface $storage, array $entities) {
  	parent::preDelete($storage, $entities);
  
  	// Delete all project assets
  	foreach ($entities as $entity) {
  		foreach($entity->field_class as $key => $val){
//   			//delete all page objects (referencing this entity)
//   			$query = \Drupal::entityQuery('page_object')
//   	  		  ->condition('field_class.entity.id', $val->entity->id());
  			if($val->entity){
  				$val->entity->delete();
  			};
//   			$ids = $query->execute();
//   			if(count($ids)){
// 	  			$entity_storage = \Drupal::
// 	  				entityTypeManager()
// 	  				->getStorage('chapters')
// 	  				->delete($val->entity->id());
//   			};
  		};
  	};
  	
  }
  
  
  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getChapters() {
  	$out = array();
  	foreach($this->field_class as $key => $val){
  		$out[] = \Drupal::service('serializer')->serialize($val->entity , 'json'); 
//   		array(
//   			"data"  => ,
//   			"name"	=> $val->entity->getName(),
//   			"id"	=> $val->entity->id(),
// 			"pages"	=> $val->entity->getPages(),
//   			"students"	=> $val->entity->getPageObject(),
  				
//   		);
  	}
 
  	return $out;
  }
  public function getStudents() {
  	$out = array();
  	foreach($this->field_class as $key => $val){
  		$pageObjectIds = $val->entity->getPageObjects();
  		$pageObjects = PageObject::loadMultiple($pageObjectIds);
  		foreach($pageObjects  as $pageObject ){
  			$out[] = \Drupal::service('serializer')->serialize($pageObject, 'json');
  		};
  	};
  	return $out;
  }
  /**
   * {@inheritdoc}
   */
  public function getType() {
    return $this->bundle();
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? NODE_PUBLISHED : NODE_NOT_PUBLISHED);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Project entity.'))
      ->setReadOnly(TRUE);
    $fields['type'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Type'))
      ->setDescription(t('The Project type/bundle.'))
      ->setSetting('target_type', 'project_type')
      ->setRequired(TRUE);
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Project entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Project entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Project entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Project is published.'))
      ->setDefaultValue(TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code for the Project entity.'))
      ->setDisplayOptions('form', array(
        'type' => 'language_select',
        'weight' => 10,
      ))
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
