<?php
/**
 * @file EntityAPIController
 */

namespace Drupal\classable\Controller;

use Drupal\classable\Helper\ControllerHelper;

/**
 * This will add the option to define a class instead of the
 * default class for any entity type that uses \EntityAPIController.
 *
 * Class EntityAPIController.
 * @package Drupal\classable\Controller
 */
class EntityAPIController extends \EntityAPIController {
  /**
   * @var ControllerHelper $helper
   */
  protected $helper;

  /**
   * The constructor.
   *
   * @inheritdoc
   */
  public function __construct($entity_type) {
    parent::__construct($entity_type);
    $this->helper = new ControllerHelper($this->entityInfo);

  }

  /**
   * This will cast the entities to a specified class.
   *
   * @inheritdoc
   */
  protected function attachLoad(&$queried_entities, $revision_id = FALSE) {
    $this->helper->reCast($queried_entities);
    parent::attachLoad($queried_entities, $revision_id);
  }

  /**
   * Implements EntityAPIControllerInterface.
   */
  public function create(array $values = array()) {
    $values += array('is_new' => TRUE);
    $bundle_key = $this->helper->getBundleKey();
    if (!isset($values[$bundle_key])) {
      return (object) $values;
    }

    if ($class = $this->helper->getEntityClassForBundle($values[$bundle_key])) {
      return new $class($values, $this->entityType);
    }
    return (object) $values;
  }

}
