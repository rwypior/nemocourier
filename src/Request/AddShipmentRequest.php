<?php

namespace RWypior\NemoCourier\Request;

use Behat\Transliterator\Transliterator;
use RWypior\NemoCourier\Model\Shipment;
use RWypior\NemoCourier\RequestInterface;
use RWypior\NemoCourier\Response\AddShipmentResponse;

class AddShipmentRequest implements RequestInterface
{
    private $shipments;
    private $apikey;

    /**
     * @param Shipment[] $shipments shipments to add
     */
    public function __construct(array $shipments)
    {
        $this->shipments = $shipments;
    }

    /**
     * @inheritdoc
     */
    public function setApikey(string $apikey)
    {
        $this->apikey = $apikey;
    }

    /**
     * @inheritdoc
     */
    public function getPost() : array
    {
        $shipments = [];
        
        foreach($this->shipments as $shipment)
        {
            $shipmentObj = [];

            $shipmentObj['recipient'] = $shipment->getRecipient();
            $shipmentObj['contact_person'] = $shipment->getContactPerson();
            $shipmentObj['postal_code'] = $shipment->getPostalCode();
            $shipmentObj['address'] = $shipment->getAddress();
            $shipmentObj['phone'] = $shipment->getPhone();
            $shipmentObj['email'] = $shipment->getEmail();
            $shipmentObj['service_type'] = $shipment->getServiceType();
            $shipmentObj['envelope_nr'] = $shipment->getEnvelopeNr();
            $shipmentObj['package_nr'] = $shipment->getPackageNr();
            $shipmentObj['pallet_nr'] = $shipment->getPalletNr();
            $shipmentObj['weight'] = $shipment->getWeight();
            $shipmentObj['volume'] = $shipment->getVolume();
            $shipmentObj['payer'] = $shipment->getPayer();
            $shipmentObj['cash_on_delivery_type'] = $shipment->getCashOnDeliveryType();
            $shipmentObj['cash_on_delivery'] = $shipment->getCashOnDelivery();
            $shipmentObj['bank'] = $shipment->getBank();
            $shipmentObj['iban'] = $shipment->getIban();
            $shipmentObj['declared_value'] = $shipment->getDeclaredValue();
            $shipmentObj['content'] = $shipment->getContent();
            $shipmentObj['special_conditions'] = $shipment->getSpecialConditions();
            $shipmentObj['observations'] = $shipment->getObservations();
            $shipmentObj['extra_1'] = $shipment->getExtra1();
            $shipmentObj['extra_2'] = $shipment->getExtra2();

            $this->convertEntries($shipmentObj);

            $shipments[] = $shipmentObj;
        }
        
        return [
            'data' => json_encode($shipments)
        ];
    }

    /**
     * Transliterate all diacritic characters
     * Required by Nemo
     * @param array $arr
     */
    private function convertEntries(array &$arr)
    {
        array_walk($arr, function(&$e) {
            $e = \Behat\Transliterator\Transliterator::utf8ToAscii($e);
        });
    }

    /**
     * @inheritdoc
     */
    public function getQuery() : array
    {
        return [
            'key' => $this->apikey
        ];
    }

    /**
     * @inheritdoc
     */
    public function getExpectedResponse() : string
    {
        return AddShipmentResponse::class;
    }

    /**
     * @inheritdoc
     */
    public function getRequestUrl() : string
    {
        return 'http://api.nemoexpress.net/v2/newawb.php';
    }

    /**
     * @inheritdoc
     */
    public function getMethod() : string
    {
        return RequestInterface::METHOD_POST;
    }
}