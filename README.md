
This module provides the ability use custom classes for entities and bundles..

The idea is that you can have a normal entity model instead of the default class instead of using 
the '\stdClass\' used by nodes and terms or the \Entity class used by ECK entities or field_collections. 

## Reason

The reason for this module is that you can have

* no magic \_\_call functions from entity\_metadata\_wrapper in the entire code base.
* More OOP approach.
* autocompletion for IDE for fields and methods. 
* setter\is\has\getter function on any model like this:

```PHP

    class Person extends Term {
        /**
         * @return boolean
         */
        public function isAvailable() {
            ...
        }
    }

    class Article extends Node {
        /**
         * Set title.
         */
        public function setTitle($title) {
            $this->title = $title; 
        }

        /**
         * Returns the writers.
         *
         * @return Person[]
         *   The writers.
         */
        public function getWriters() {
            return $this->wrapper()->field_writers->value();
        }
    }
    
    /** @var Article $article */
    $article = node_load('article', 1);
    
    $article->getWriters()[0]->isAvailable();

    if ($article instanceof Article) {
        $article->setTitle("Some title");    
    }

```

## Current override support (Entity-Bundle)

* Node
* Terms
* Field collection
* ECK entities

## Usage

See 'classable.api.php' how to specify your class with hooks.

```PHP
    function hook_entity_info_alter(&$entity_info) {
      // Set class on taxonomy term bundle.
      $entity_info['taxonomy_term']['bundles']['<vocabulary name>']['entity class'] = '\Drupal\classable\Entity\Term';
      // Set class on node bundle.
      $entity_info['node']['bundles']['<bundle name>']['entity class'] = '\Drupal\classable\Entity\Node';
    ...
```

The module does NOT set the default Drupal\classable\Entity\Node or Drupal\classable\Entity\Term. 
The reason for this is that we don't want to provide a default super class Like \Entity ([why-getter-and-setter-methods-are-evil](http://www.javaworld.com/article/2073723/core-java/why-getter-and-setter-methods-are-evil.html))
And it's only needed when the entity is used inside your own codebase with functions that are useful for your specific 
purpose and domain.

You can still implement this with the following hook:

```PHP
    function hook_entity_info_alter(&$entity_info) {
      // Make all terms instance of Term.
      $entity_info\['taxonomy_term']['entity class'] = '\Drupal\classable\Entity\Term';
      
      // Make all nodes instance of Node.
      $entity_info['node']['entity class'] = '\Drupal\classable\Entity\Node';
    }
```

## Make file
```
projects[classable][type] = module
projects[classable][download][type] = git
projects[classable][download][branch] = "7.x-1.x"
projects[classable][download][url] = "http://github.com/ibuildingsnl/classable.git"
```
