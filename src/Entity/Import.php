<?php

namespace DeepFreeze\Wsdl\Entity;

class Import {
  /** @var  Uri */
  private $namespace;
  /** @var  Uri */
  private $location;

  /**
   * @return Uri
   */
  public function getLocation() {
    return $this->location;
  }


  /**
   * @param Uri $location
   */
  public function setLocation($location) {
    $this->location = $location;
  }


  /**
   * @return Uri
   */
  public function getNamespace() {
    return $this->namespace;
  }


  /**
   * @param Uri $namespace
   */
  public function setNamespace($namespace) {
    $this->namespace = $namespace;
  }

}
