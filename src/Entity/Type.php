<?php

namespace DeepFreeze\Wsdl\Entity;

class Type {
  /**
   * @var Documentation
   */
  private $documentation;
  /**
   * @var Xsd\Schema[]
   */
  private $schema = array();
  /**
   * @var array()
   */
  private $extensibility = array();
}
