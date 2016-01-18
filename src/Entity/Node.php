<?php
/**
 * @file
 * Node.
 */

namespace Drupal\classable\Entity;

use EntityDrupalWrapper;

/**
 * Class Node.
 *
 * @package Drupal\classable\Entity
 */
class Node extends \stdClass {

  /**
   * Node constructor.
   *
   * @param string $node_type
   *   The type of the node.
   */
  public function __construct($node_type = NULL) {
    if (is_string($node_type)) {
      $this->type = $node_type;
    }
  }

  /**
   * Returns the Nid.
   *
   * @return int
   *   The id.
   */
  public function getId() {
    return (int) $this->nid;
  }

  /**
   * Returns the title.
   *
   * @return string
   *   The title.
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Returns if the node is published.
   *
   * @return bool
   *   TRUE if published.
   */
  public function isPublished() {
    return $this->status === NODE_PUBLISHED;
  }

  /**
   * Returns the created date.
   *
   * @Return int
   *   The unix stamp.
   */
  public function getCreatedDate() {
    return $this->created;
  }

  /**
   * Returns the updated date.
   *
   * @Return int
   *   The unix stamp.
   */
  public function getChangedDate() {
    return $this->changed;
  }

  /**
   * This property is not defined because protected or private properties will
   * make the DBGp protocol (xml) from xdebug invalid on array cast
   * and crashes the xdebug clients.
   *
   * Casting a class with private properties is Valid php,
   * and the bug is recognized by xdebug, but not yet fixed:
   *
   * http://bugs.xdebug.org/view.php?id=940 closed for
   * http://bugs.xdebug.org/view.php?id=924
   *
   * Node to array casting is done inside:
   * @see template_preprocess_node
   *
   * @private
   * @var EntityDrupalWrapper $wrapper
   */

  /**
   * Returns the EntityMetadataWrapper of the entity.
   *
   * @return EntityDrupalWrapper
   *   An EntityMetadataWrapper containing the entity.
   */
  protected function wrapper() {
    if (empty($this->wrapper)) {
      $this->wrapper = entity_metadata_wrapper('node', $this);
    }
    return $this->wrapper;
  }

}
