<?php

/**
 * @file
 * Contains \Drupal\lifebook\Entity\composition.
 */

namespace Drupal\lifebook\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\lifebook\compositionInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Composition entity.
 *
 * @ingroup lifebook
 *
 * @ContentEntityType(
 *   id = "composition",
 *   label = @Translation("Composition"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lifebook\compositionListBuilder",
 *     "views_data" = "Drupal\lifebook\Entity\compositionViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\lifebook\Form\compositionForm",
 *       "add" = "Drupal\lifebook\Form\compositionForm",
 *       "edit" = "Drupal\lifebook\Form\compositionForm",
 *       "delete" = "Drupal\lifebook\Form\compositionDeleteForm",
 *     },
 *     "access" = "Drupal\lifebook\compositionAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\lifebook\compositionHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "composition",
 *   admin_permission = "administer composition entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/lifebook/composition/{composition}",
 *     "add-form" = "/lifebook/composition/add",
 *     "edit-form" = "/lifebook/composition/{composition}/edit",
 *     "delete-form" = "/lifebook/composition/{composition}/delete",
 *     "collection" = "/lifebook/composition",
 *   },
 *   field_ui_base_route = "composition.settings"
 * )
 */
class composition extends ContentEntityBase implements compositionInterface {
  use EntityChangedTrait;
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
      ->setDescription(t('The ID of the Composition entity.'))
      ->setReadOnly(TRUE);
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Composition entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Composition entity.'))
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
      ->setDescription(t('The name of the Composition entity.'))
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
	
	$fields['data'] = BaseFieldDefinition::create('json')
      ->setLabel(t('Data'))
      ->setDescription(t('The data of the Composition entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('{"objects":[],"background":""}')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'json',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'json_textarea',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
	
	$fields['meta'] = BaseFieldDefinition::create('json')
      ->setLabel(t('Meta'))
      ->setDescription(t('The Meta information for the Composition'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('{"preview":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAABVCAIAAAHtYiAhAAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB+AFCg8RBswrHy4AAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAgUlEQVRo3u3XQQqFMAxAwST3v3O8QLsoqBiZLDU8hvo/YnZ3rKZiM7+/kcsjqYPItKu5+xGcHZztcduevG3b/vM3TcVjIy0tLS0tPTLttSstLS0tLS0tLS0tLS0t/Y0P6ZHnAQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDf3eXKN0FicG67qgAAAAAElFTkSuQmCC"}')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'json',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'json_textarea',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Composition is published.'))
      ->setDefaultValue(TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code for the Composition entity.'))
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
