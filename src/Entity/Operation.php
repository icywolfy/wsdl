<?php

namespace DeepFreeze\Wsdl\Entity;

use DeepFreeze\Xml\Entity\NameToken;

class Operation {
  /**
   * @var Documentation
   */
  private $documentation;
  /**
   * @var OperationInput
   */
  private $input;
  /**
   * @var OperationOutput
   */
  private $output;
  /**
   * @var OperationFault[]
   */
  private $faults = array();
}
