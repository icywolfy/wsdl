<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class Message {
  /**
   * @var NameToken
   */
  private $name;
  /**
   * @var Documentation
   */
  private $documentation;
  /**
   * @var MessagePart[]
   */
  private $parts = array();


  /**
   * @return Documentation
   */
  public function getDocumentation() {
    return $this->documentation;
  }


  /**
   * @param Documentation $documentation
   */
  public function setDocumentation($documentation) {
    $this->documentation = $documentation;
  }


  /**
   * @return NameToken
   */
  public function getName() {
    return $this->name;
  }


  /**
   * @param NameToken $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  public function appendPart(MessagePart $part) {
    $this->parts[] = $part;
  }
}
