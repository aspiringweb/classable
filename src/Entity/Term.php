<?php

namespace Drupal\classable\Entity;

use EntityDrupalWrapper;

class Term extends \stdClass {

  /**
   * Returns the TID.
   *
   * @return int
   *   The id.
   */
  public function getId() {
    return (int) $this->tid;
  }

  /**
   * Returns the TID.
   *
   * @return int
   *   The id.
   */
  public function getVocabularyId() {
    return (int) $this->vid;
  }

  /**
   * Returns the vocabulary machine name.
   *
   * @return string
   *   The name.
   */
  public function getVocabularyMachineName() {
    return $this->vocabulary_machine_name;
  }

  /**
   * Returns name of the term.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Return the ids.
   *
   * @param Term[] $terms
   *   The terms.
   *
   * @return int[]
   *   The ids.
   */
  public static function toIds(array $terms) {
    $ids = [];
    foreach ($terms as $term) {
      $ids[] = (int) $term->getId();
    }
    return $ids;
  }

  /**
   * @var EntityDrupalWrapper
   */
  private $wrapper;

  /**
   * Returns the EntityMetadataWrapper of the entity.
   *
   * @return EntityDrupalWrapper
   *   An EntityMetadataWrapper containing the entity.
   */
  protected function wrapper() {
    if (empty($this->wrapper)) {
      $this->wrapper = entity_metadata_wrapper('taxonomy_term', $this);
    }
    return $this->wrapper;
  }

}
