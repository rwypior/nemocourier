<?php

include '../vendor/autoload.php';

$apikey = '';

$nemo = new \RWypior\NemoCourier\Nemo($apikey);

$shipment = new RWypior\NemoCourier\Model\Shipment();
$shipment
    ->setRecipient('TEST PERSON Łąść')
    ->setContactPerson('TEST PERSON')
    ->setPostalCode('77165')
    ->setAddress('Băncilă TEST ADDRESS')
    ->setPhone('0123456789')
    ->setEmail('test@email.ro')
    ->setServiceType(\RWypior\NemoCourier\Model\Shipment::SERVICE_TYPE_NEXTDAY)
    ->setEnvelopeNr(1)
    ->setPackageNr(0)
    ->setPalletNr(0)
    ->setWeight(1.0)
    ->setVolume(0)
    ->setPayer(\RWypior\NemoCourier\Model\Shipment::PAYER_TYPE_SENDER)
    ->setCashOnDeliveryType(\RWypior\NemoCourier\Model\Shipment::COD_TYPE_CASH)
    ->setCashOnDelivery(2299.9)
    ->setDeclaredValue(2299.9)
    ->setExtra1('test');

$request = new RWypior\NemoCourier\Request\AddShipmentRequest([
    $shipment
]);

$response = $nemo->sendRequest($request);

var_dump($response);