<?php

include '../vendor/autoload.php';

$apikey = '';
$awbs = ['awb1', 'awb2', 'awb3'];

$nemo = new \RWypior\NemoCourier\Nemo($apikey);

$request = new \RWypior\NemoCourier\Request\CheckStatusRequest($awbs);

/** @var \RWypior\NemoCourier\Response\CheckStatusResponse $response */
$response = $nemo->sendRequest($request);

var_dump([
    'delivered' => $response->isDelivered($awbs[0]),
    'refused' => $response->isRefused($awbs[0]),
    'inTransit' => $response->isInTransit($awbs[0])
]);

var_dump($response);