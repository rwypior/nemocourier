<?php

namespace RWypior\NemoCourier\Response;

use RWypior\NemoCourier\Exception\CourierException;
use RWypior\NemoCourier\Model\CreatedShipment;
use RWypior\NemoCourier\ResponseInterface;

class AddShipmentResponse implements ResponseInterface
{
    private $results = [];

    protected function __construct($results)
    {
        $this->results = $results;
    }

    public static function createResponse($data) : ResponseInterface
    {
        $json = json_decode($data);

        if ($json->isError)
        {
            $msg = implode('; ', $json->messages);
            throw new CourierException('Request failed: ' . $msg, CourierException::EXCCODE_REQUEST_FAILED);
        }

        $results = [];
        
        if (isset($json->results) && is_array($json->results))
        {
            foreach($json->results as $result)
            {
                $results[] = $resultObject = new CreatedShipment();
                $resultObject->setAwb($result->awb);
                $resultObject->setBarcode($result->barcode);
            }
        }

        return new AddShipmentResponse($results);
    }

    /**
     * @return CreatedShipment[]
     */
    public function getResults() : array
    {
        return $this->results;
    }

}