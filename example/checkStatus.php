<?php

include '../vendor/autoload.php';

$apikey = '';
$awbs = [];

$nemo = new \RWypior\NemoCourier\Nemo($apikey);

$request = new \RWypior\NemoCourier\Request\CheckStatusRequest($awbs);

/** @var \RWypior\NemoCourier\Response\CheckStatusResponse $response */
$response = $nemo->sendRequest($request);

var_dump([
    'delivered' => $response->isDelivered(),
    'refused' => $response->isRefused(),
    'inTransit' => $response->isInTransit()
]);

var_dump($response);