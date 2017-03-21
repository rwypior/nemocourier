<?php

namespace RWypior\NemoCourier\Model;

/**
 * Response model for create shipment request
 */
class CreatedShipment
{
    private $awb;
    private $barcode;
    
    public function getAwb()
    {
        return $this->awb;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }

    public function setAwb($awb)
    {
        $this->awb = $awb;
        return $this;
    }

    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
        return $this;
    }
}