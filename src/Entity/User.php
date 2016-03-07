<?php
/**
 * @file
 * User.
 */

namespace Drupal\classable\Entity;

use EntityDrupalWrapper;

/**
 * Class User.
 *
 * @package Drupal\classable\Entity
 */
class User extends \stdClass {
  /**
   * Returns the Nid.
   *
   * @return int
   *   The id.
   */
  public function getId() {
    return (int) $this->uid;
  }

  /**
   * Returns the title.
   *
   * @return string
   *   The title.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Returns if the User is a anonymous user.
   *
   * @return bool
   *   TRUE if published.
   */
  public function isAnonymous() {
    return !$this->uid || in_array('anonymous user', $this->roles);
  }

  /**
   * Returns the EntityMetadataWrapper of the entity.
   *
   * @return EntityDrupalWrapper
   *   An EntityMetadataWrapper containing the entity.
   */
  protected function wrapper() {
    if (empty($this->wrapper)) {
      $this->wrapper = entity_metadata_wrapper('User', $this);
    }
    return $this->wrapper;
  }

}
