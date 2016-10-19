<?php

namespace DeepFreeze\Wsdl\Entity;

class Documentation {
  /**
   * @var string
   */
  private $content;


  /**
   * @var \DOMAttr
   */
  private $extensionAttributes = array();

  public function __construct($content=null) {
    $this->setContent($content);
  }


  /**
   * @return string
   */
  public function getContent() {
    return $this->content;
  }


  /**
   * @param string $content
   */
  public function setContent($content) {
    $this->content = $content;
  }


  public function appendExtensionAttribute(\DOMAttr $attribute) {
    $this->extensionAttributes[] = $attribute;
  }
  public function __toString() {
    return (string)$this->getContent();
  }
}
