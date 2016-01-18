<?php
/**
 * @file
 * ControllerHelper.
 */

namespace Drupal\classable\Helper;

/**
 * Class ControllerHelper.
 *
 * @package Drupal\classable\Helper
 */
class ControllerHelper {
  /**
   * @var array $entityInfo
   */
  protected $entityInfo;

  /**
   * Associative array bundle_name -> class_name|NULL
   *
   * @var string[] $bundleNameClassMap
   */
  protected $bundleNameClassMap = array();

  /**
   * @var string $bundleKey
   */
  protected $bundleKey = NULL;

  /**
   * Constructor.
   *
   * @param array $entity_info
   *   The controller.
   */
  public function __construct(array $entity_info) {
    $this->entityInfo = $entity_info;
  }

  /**
   * Recast entities.
   *
   * @param array $entities
   *   The entities to cast.
   */
  public function reCast(&$entities) {
    foreach ($entities as &$entity) {
      $entity = $this->reCastSingleEntity($entity);
    }
  }

  /**
   * Recast single entity.
   *
   * @param mixed $entity
   *   The entity to cast.
   *
   * @return mixed
   *   The entity casted.
   */
  public function reCastSingleEntity($entity) {
    $bundle_name = $this->getBundleNameFromEntity($entity);
    if (!is_string($bundle_name)) {
      return $entity;
    }
    $entity_class = $this->getEntityClassForBundle($bundle_name);
    if (!is_string($entity_class)) {
      return $entity;
    }
    return $this->toClass($entity_class, $entity);
  }

  /**
   * Returns the class name of the entity.
   *
   * @param mixed $entity
   *   The entity class.
   *
   * @return null|string
   *   The entity class
   */
  public function getEntityClass($entity) {
    $bundle_name = $this->getBundleNameFromEntity($entity);
    if (!is_string($bundle_name)) {
      return NULL;
    }
    $entity_class = $this->getEntityClassForBundle($bundle_name);
    if (!is_string($entity_class)) {
      return NULL;
    }
    return $entity_class;
  }

  /**
   * Returns the entity class from bundle info.
   *
   * Creates a class map for bundle_name.
   *
   * @param string $bundle_key
   *   The bundle key.
   *
   * @return string|null
   *   The class name if given.
   */
  public function getEntityClassForBundle($bundle_key) {
    if (isset($this->bundleNameClassMap[$bundle_key])) {
      return $this->bundleNameClassMap[$bundle_key];
    }
    $this->bundleNameClassMap[$bundle_key] = $this->resolveEntityClassName($bundle_key);
    return $this->bundleNameClassMap[$bundle_key];
  }

  /**
   * Returns the bundle key.
   *
   * @return string
   *   The bundle key.
   */
  public function getBundleKey() {
    if (is_string($this->bundleKey)) {
      return $this->bundleKey;
    }
    $entity_info = $this->entityInfo;
    if (isset($entity_info['entity keys']['bundle'])) {
      $this->bundleKey = $entity_info['entity keys']['bundle'];
    }
    elseif (isset($entity_info['bundle keys']['bundle'])) {
      $this->bundleKey = $entity_info['bundle keys']['bundle'];
    }
    return $this->bundleKey;
  }

  /**
   * Recast stdClass object to an object with type.
   *
   * @param string $entity_class
   *   The class to cast to.
   * @param \stdClass $object
   *   The entity to cast a object.
   *
   * @return mixed
   *   The entity casted.
   */
  protected function toClass($entity_class, $object) {
    // Don't recast to the same class.
    if ($object instanceof $entity_class) {
      return $object;
    }

    /*
     * This can give an error if you did not override
     * the constructor inside an Entity class
     * Like
     *
     * function __construct($options = array()) {
     *   parent::__construct($options, '<your entity type>')
     */
    $new = new $entity_class();

    // Assign variables.
    foreach ($object as $property => $value) {
      $new->{$property} = $value;
    }

    return $new;
  }

  /**
   * Returns the bundle name of a entity.
   *
   * @param mixed $entity
   *   The entity.
   *
   * @return string|NULL
   *   The name of the bundle.
   */
  protected function getBundleNameFromEntity($entity) {
    $bundle_key = $this->getBundleKey();
    if (!is_string($bundle_key)) {
      return NULL;
    }
    return $entity->{$bundle_key};
  }

  /**
   * Resolves the entity class from bundle info.
   *
   * @param string $bundle_key
   *   The bundle key.
   *
   * @return string|null
   *   The class name if given.
   */
  private function resolveEntityClassName($bundle_key) {
    $entity_info = $this->entityInfo;
    $bundle_info = $entity_info['bundles'][$bundle_key];
    if (isset($bundle_info['entity class'])) {
      return $bundle_info['entity class'];
    }
    elseif (isset($entity_info['entity class'])) {
      return $entity_info['entity class'];
    }
    return NULL;
  }

}
