<?php
include __DIR__ . '/vendor/autoload.php';
$wsdlReader = new \DeepFreeze\Wsdl\Reader\WsdlXmlReader();

$xml = file_get_contents(__DIR__  . '/data/Account.wsdl');
$wsdlReader->parse($xml);
