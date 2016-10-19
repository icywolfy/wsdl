<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class OperationInput {
  /**
   * @var NameToken;
   */
  private $name;
  /**
   * @var QualifiedName
   */
  private $message;
  /**
   * @var Documentation
   */
  private $documentation;
}
