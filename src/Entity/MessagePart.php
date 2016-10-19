<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class MessagePart {
  /**
   * @var NameToken
   */
  private $name;
  /**
   * @var NameToken
   */
  private $element;
  /**
   * @var QualifiedName
   */
  private $type;
}
