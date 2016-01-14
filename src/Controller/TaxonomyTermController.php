<?php

namespace Drupal\classable\Controller;

use Drupal\classable\CastToClassInterface;
use Drupal\classable\Helper\ControllerHelper;

/**
 * This will add the option to define a class instead of the default
 * \stdClass for a Term.
 *
 * Class TaxonomyTermController
 * @package Drupal\classable\Controller
 */
class TaxonomyTermController extends \TaxonomyTermController
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
  protected function attachLoad(&$queried_entities, $revision_id = FALSE) {
    $this->helper->reCast($queried_entities);
    parent::attachLoad($queried_entities, $revision_id);
  }

  /**
   * Cast entity to class.
   *
   * @inheritdoc
   */
  public function castToClass(\stdClass $entity) {
    return $this->helper->reCastSingleEntity($entity);
  }
}
