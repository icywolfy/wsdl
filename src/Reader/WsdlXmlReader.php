<?php
namespace DeepFreeze\Wsdl\Reader;

use DeepFreeze\Wsdl\Entity\Documentation;
use DeepFreeze\Wsdl\Entity\Import;
use DeepFreeze\Wsdl\Entity\Message;
use DeepFreeze\Wsdl\Exception\XmlException;
use DeepFreeze\Wsdl\Wsdl;

class WsdlXmlReader
{
  /**
   * WSDL Namespace
   * @var string
   */
  const NAMESPACE_WSDL = 'http://schemas.xmlsoap.org/wsdl/';
  /**
   * @var \DOMDocument
   */
  private $document;
  /**
   * @var \DOMElement
   */
  private $rootNode;
  /**
   * @var Wsdl
   */
  private $wsdl;


  private function reset() {
    $this->document = null;
    $this->wsdl = null;
  }


  public function parse($xml) {
    $document = $this->getDocumentForXml($xml);
    $definitionNode = $document->documentElement;
    return $this->parseWsdlDefinition($definitionNode);
  }


  public function parseWsdlDefinition(\DOMElement $element) {
    $this->reset();
    $this->wsdl = new Wsdl();
    $this->document = $element->ownerDocument;
    $this->rootNode = $element;
    $this->validateRootNode();
    $this->parseDefinition();
    return $this->wsdl;
  }


  private function getQualifiedName(\DOMNode $node) {
    $namespace = $node->namespaceURI;
    $localName = $node->localName;
    return $this->createQualifiedName($localName, $namespace);
  }


  private function createQualifiedName($localName, $namespace) {
    $qualifiedName = $namespace ? sprintf("{$namespace}$localName") : $localName;
    return $qualifiedName;
  }


  private function validateRootNode() {
    $node = $this->rootNode;
    $this->validateNodeName($node, 'definitions', static::NAMESPACE_WSDL);
  }


  private function parseDefinition() {
    $node = $this->rootNode;
    // Attributes
    $this->wsdl->setName($node->getAttribute('name'));
    $this->wsdl->setTargetNamespace($node->getAttribute('targetNamespace'));
    // Cycle through all the children
    if (!$node->hasChildNodes()) {
      return;
    }

    foreach ($node->childNodes as $childNode) {
      /**
       * @var \DOMNode $childNode
       */
      echo $childNode->nodeType, ':', $childNode->nodeName, PHP_EOL;
      if (XML_ELEMENT_NODE != $childNode->nodeType) {
        continue;
      }
      if ($childNode->namespaceURI !== static::NAMESPACE_WSDL) {
        $this->wsdl->addExtensionNode($childNode);
        continue;
      }
      /** @var \DOMElement $node */
      switch ($node->localName) {
        case 'import':
          $import = $this->parseImportNode($node);
          break;

        case 'documentation':
          $documentation = $this->parseDocumentationNode($node);
          $this->wsdl->setDocumentation($documentation);
          break;

        case 'types':
          $this->parseTypesNode($node);
          break;

        case 'message':
          $this->parseMessageNode($node);
          break;

        case 'portType':
          $this->parsePortTypeNode($node);
          break;

        case 'binding':
          $this->parseBindingNode($node);
          break;
        case 'service':
          $this->parseServiceNode($node);
          break;

        default:
          $this->wsdl->addExtensionNode($childNode);
          break;
      }
    }
  }


  private function getDocumentForXml($xml) {
    $document = new \DOMDocument();
    $result = $document->loadXML($xml);
    if (!$result) {
      $e = libxml_get_last_error();
      if ($e) {
        $e = new \Exception($e->message);
      }
      throw new XmlException('Unable to parse XML.', 0, $e);
    }
    return $document;
  }

  private function parseImportNode(\DOMElement $node) {
    $this->validateNodeName($node, 'import', static::NAMESPACE_WSDL);
    $namespace = $node->getAttribute('namespace');
    $location = $node->getAttribute('location');
    $import = new Import();
    $import->setNamespace($namespace);
    $import->setLocation($location);
    return $import;
  }

  private function validateNodeName(\DOMNode $node, $localName, $namespaceUri=null) {
    $expectedName = $this->createQualifiedName($localName, $namespaceUri);
    $qualifiedName = $this-$this->getQualifiedName($node);
    if ($expectedName !== $qualifiedName) {
      throw new XmlException('Expected Node of type "%s", given "%s"',
        $qualifiedName,
        $expectedName);
    }
  }

  private function parseDocumentationNode(\DOMElement $node) {
    $this->validateNodeName($node, 'documentation', static::NAMESPACE_WSDL);
    $documentation = new Documentation();
    if ($node->hasAttributes()) {
      foreach ($node->attributes as $attribute) {
        $documentation->appendExtensionAttribute($attribute);
      }
    }
    $content = $this->innerXml($node);
    $documentation->setContent($content);
    return $documentation;
  }

  private function innerXml(\DOMElement $node) {
    if (!$node->hasChildNodes()) {
      return '';
    }

    $content = array_map(array($this->document, 'saveXML'), iterator_to_array($node->childNodes));
    $content = implode('', $content);
    return $content;
  }

  private function parseMessage(\DOMElement $node) {
    $this->validateNodeName($node, 'message', static::NAMESPACE_WSDL);
    $name = $node->getAttribute('name');
    $message = new Message();
    $message->setName($name);
    if ($node->hasChildNodes()) {
      foreach ($node->childNodes as $childNode) {
        /**
         * @var \DOMNode $childNode
         */
        if (XML_ELEMENT_NODE != $childNode->nodeType) {
          continue;
        }
        if ($childNode->namespaceURI !== static::NAMESPACE_WSDL) {
          $this->wsdl->addExtensionNode($childNode);
          continue;
        }
        /** @var \DOMElement $node */
        switch ($node->localName) {

        }
      }
    }
    return $message;
  }

  private function isWsdlNamespace (\DOMElement $node) {
    return (static::NAMESPACE_WSDL === $node->namespaceURI);
  }

  private function isElement(\DOMNode $node ) {
    return ($node->nodeType === XML_ELEMENT_NODE);
  }
}
