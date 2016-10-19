<?php


namespace DeepFreeze\Wsdl;

use DeepFreeze\Wsdl\Entity\Binding;
use DeepFreeze\Wsdl\Entity\Documentation;
use DeepFreeze\Wsdl\Entity\Import;
use DeepFreeze\Wsdl\Entity\Port;
use DeepFreeze\Wsdl\Entity\Service;
use DeepFreeze\Wsdl\Entity\Type;
use DeepFreeze\Xml\Entity\NameToken;

class Wsdl {
  /**
   * @var Uri
   */
  private $name;
  /**
   * @var NameToken
   */
  private $targetNamespace;
  /**
   * @var Documentation;
   */
  private $documentation;
  /**
   * @var Import[]
   */
  private $imports = array();
  /**
   * @var Type[]
   */
  private $types;
  /**
   * @var Message
   */
  private $messages = array();
  /**
   * @var Port[]
   */
  private $ports = array();
  /**
   * @var Binding[]
   */
  private $bindings = array();
  /**
   * @var Service[]
   */
  private $services = array();
  /**
   * @var \DOMNode[]
   */
  private $extensibility = array();


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


  /**
   * @return Uri
   */
  public function getTargetNamespace() {
    return $this->targetNamespace;
  }


  /**
   * @param Uri $targetNamespace
   */
  public function setTargetNamespace($targetNamespace) {
    $this->targetNamespace = $targetNamespace;
  }


  public function addExtensionNode(\DOMNode $node) {
    $this->extensibility[] = $node;
  }


  /**
   * @return Documentation
   */
  public function getDocumentation() {
    if (is_string($this->documentation)) {
      $doc = new Documentation($this->documentation);
      $this->setDocumentation($doc);
    }
    return $this->documentation;
  }


  /**
   * @param Documentation|string $documentation
   */
  public function setDocumentation($documentation) {
    $this->documentation = $documentation;
  }


  public function appendImport(Import $import) {
    $this->imports[] = $import;
  }

  public function appendMessage(Message $message) {
    $this->messages[] = $message;
  }

  public function appendPort(Port $port) {
    $this->ports[] = $port;
  }

  public function addBinding(Binding $binding) {
    $this->bindings[] = $binding;
  }
  public function addService (Service $service) {
    $this->services[] = $service;
  }
}
