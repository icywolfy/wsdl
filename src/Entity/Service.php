<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class Service {
  /**
   * @var NameToken
   */
  private $name;
  /**
   * @var Documentation
   */
  private $documentation;
  /**
   * @var ServicePort
   */
  private $port;
}
