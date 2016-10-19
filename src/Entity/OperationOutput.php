<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class OperationOutput {
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
