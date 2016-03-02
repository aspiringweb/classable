<?php
/**
 * @file
 * UserController.
 */

namespace Drupal\classable\Controller;

use Drupal\classable\CastToClassInterface;
use Drupal\classable\Helper\ControllerHelper;

/**
 * Class UserController.
 *
 * This will add the option to define a class instead
 * of the default \stdClass for a User.
 *
 * @package Drupal\classable\Controller
 */
class UserController extends \UserController
  implements CastToClassInterface {

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
  function attachLoad(&$queried_entities, $revision_id = FALSE) {
    $this->helper->reCast($queried_entities);
    parent::attachLoad($queried_entities, $revision_id);
  }

  /**
   * Cast node to class.
   *
   * @inheritdoc
   */
  public function castToClass(\stdClass $user) {
    return $this->helper->reCastSingleEntity($user);
  }

}
