<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class Binding {

  /**
   * @var NameToken
   */
  private $name;
  /**
   * @var QualifiedName
   */
  private $type;
  /**
   * @var Documentation
   */
  private $documentation;
  /**
   * @var Operation[]
   */
  private $operations = array();
}
