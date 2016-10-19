<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class ServicePort
{
  /**
   * @var NameToken
   */
  private $name;
  /**
   * @var QualifiedName
   */
  private $binding;
  /**
   * @var Documentation
   */
  private $documentation;
}
