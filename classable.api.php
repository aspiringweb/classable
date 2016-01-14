<?php
/**
 * @file
 * Example classable API file.
 */

/**
 * Example alter to add a class to an entity or an entity bundle.
 *
 * Don't forget to extend the corresponding entity class.
 *
 * Implements hook_entity_info_alter().
 */
function hook_entity_info_alter(&$entity_info) {
  // Set class on ECK entity.
  $entity_info['<entity name>']['entity class'] = '\Entity';

  // Set class on ECK bundle.
  $entity_info['<entity name>']['bundles']['<bundle name>']['entity class'] = '\Entity';

  // Set class on taxonomy term entity.
  $entity_info['taxonomy_term']['entity class'] = '\Drupal\classable\Entity\Term';

  // Set class on taxonomy term bundle.
  $entity_info['taxonomy_term']['bundles']['<vocabulary name>']['entity class'] = '\Drupal\classable\Entity\Term';

  // Set class on field_collection_item entity.
  $entity_info['field_collection_item']['entity class'] = '\FieldCollectionItemEntity';

  // Set class on field_collection_item bundle.
  $entity_info['field_collection_item']['bundles']['<field name>']['entity class'] = '\FieldCollectionItemEntity';

  // Set class node entity.
  $entity_info['node']['entity class'] = '\Drupal\classable\Entity\Node';

  // Set class node bundle.
  $entity_info['node']['bundles']['<bundle name>']['entity class'] = '\Drupal\classable\Entity\Node';
}

/**
 * This hook provides a way to alter the $controller_overrides_map.
 *
 * With this you can provide your own classable controller
 * because a other module already overrides the entity controller or the entity
 * type is not yet supported by classable.
 *
 * Take a look at {@see Drupal\classable\Controller\NodeController} or
 * {@see Drupal\classable\Controller\TaxonomyTermController}
 * for 2 implementations.
 *
 * @param array $controller_overrides_map
 *   An associative array of entity_type => controller_class.
 */
function hook_classable_controller_overrides_alter(
  array &$controller_overrides_map
) {
  $controller_overrides_map['node'] = '\Drupal\classable\Controller\NodeController';
}
