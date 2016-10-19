<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class Port {
  /**
   * @var Documentation
   */
  private $documentation;
  /**
   * @var NameToken
   */
  private $name;
  /**
   * @var Operation[]
   */
  private $operations = array();
}
