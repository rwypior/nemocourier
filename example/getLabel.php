<?php

include '../vendor/autoload.php';

$apikey = '';
$awb = '';

$nemo = new \RWypior\NemoCourier\Nemo($apikey);

$request = new \RWypior\NemoCourier\Request\GetLabelRequest($awb);

$response = $nemo->sendRequest($request);

var_dump(strlen($response->getContent()));
file_put_contents('/tmp/testlabelnemo.pdf', $response->getContent());
