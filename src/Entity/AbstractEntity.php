<?php
/**
 * @file AbstractEntity.
 */

namespace Drupal\classable\Entity;

/**
 * Class AbstractEntity.
 * @package Drupal\classable\Entity
 */
abstract class AbstractEntity extends \Entity {
  /**
   * Abstract entity constructor.
   *
   * This constructor is defined to set the default bundle type inside the
   * derived class.
   *
   * @inheritdoc
   */
  public function __construct(array $values = array(), $entity_type = NULL, $bundle_type = NULL) {
    if (!isset($values['type'])) {
      $values['type'] = $bundle_type;
    }
    parent::__construct($values, $entity_type);
  }

}
