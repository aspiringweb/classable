<?php

namespace Drupal\classable;

interface CastToClassInterface {
  /**
   * Cast an entity to class.
   *
   * Used for _classable_create_entity_callback if the creation is not done
   * by a controller.
   *
   * @parem \stdClass $node
   *   The entity.
   *
   * @return \stdClass|mixed
   *   The entity casted to correct class.
   */
  public function castToClass(\stdClass $entity);
}
