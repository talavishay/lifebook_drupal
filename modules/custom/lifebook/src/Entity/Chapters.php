<?php

namespace Drupal\lifebook\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\lifebook\ChaptersInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Chapters entity.
 *
 * @ingroup lifebook
 *
 * @ContentEntityType(
 *   id = "chapters",
 *   label = @Translation("Chapters"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lifebook\ChaptersListBuilder",
 *     "views_data" = "Drupal\lifebook\Entity\ChaptersViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\lifebook\Form\ChaptersForm",
 *       "add" = "Drupal\lifebook\Form\ChaptersForm",
 *       "edit" = "Drupal\lifebook\Form\ChaptersForm",
 *       "delete" = "Drupal\lifebook\Form\ChaptersDeleteForm",
 *     },
 *     "access" = "Drupal\lifebook\ChaptersAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\lifebook\ChaptersHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "chapters",
 *   admin_permission = "administer chapters entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/lifebook/chapters/{chapters}",
 *     "add-form" = "/lifebook/chapters/add",
 *     "edit-form" = "/lifebook/chapters/{chapters}/edit",
 *     "delete-form" = "/lifebook/chapters/{chapters}/delete",
 *     "collection" = "/lifebook/chapters",
 *   },
 *   field_ui_base_route = "chapters.settings"
 * )
 */
class Chapters extends ContentEntityBase implements ChaptersInterface {

  use EntityChangedTrait;

  
  
  /**
   * {@inheritdoc}
   */
  public static function preDelete(EntityStorageInterface $storage, array $entities) {
  	parent::preDelete($storage, $entities);
  
//   	// Delete all project assets
//   	foreach ($entities as $entity) {
//   		foreach($entity->field_class as $key => $val){
//   			if($val->entity){
//   				$val->entity->delete();
//   			}
//   		};
//   	};
  	 
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
  public function getPages() {
  	$out = array();
  	foreach($this->field_pages_ref as $key => $val){  			
  		$out[] = $val->entity->id();
  	}
  	return $out;
  }
  
  public function getPageObject() {
  	$query = \Drupal::entityQuery('page_object')
  	    ->condition('field_class.entity.id', $this->id());;
  	
  	return $query->execute(); 
  	
  }
  
  public function getProject() {
  	$query = \Drupal::entityQuery('project')
  	->condition('field_class.entity.id', $this->id());;
  	 
  	return $query->execute();
  	 
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
      ->setDescription(t('The ID of the Chapters entity.'))
      ->setReadOnly(TRUE);
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Chapters entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Chapters entity.'))
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
      ->setDescription(t('The name of the Chapters entity.'))
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
      ->setDescription(t('A boolean indicating whether the Chapters is published.'))
      ->setDefaultValue(TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code for the Chapters entity.'))
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
