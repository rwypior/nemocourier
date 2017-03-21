<?php

namespace RWypior\NemoCourier\Model;

class Shipment
{
    const COD_TYPE_CASH = 'CASH';
    const COD_TYPE_CONT = 'CONT';
    const COD_TYPE_BO = 'BO';
    const COD_TYPE_CEC = 'CEC';
    const COD_TYPE_BOCEC = 'BOCEC';

    const SERVICE_TYPE_NEXTDAY = 'NDD';
    const SERVICE_TYPE_SAMEDAY = 'SDD';

    const SPECIAL_CONDITIONS_NONE = '';
    const SPECIAL_CONDITIONS_RETURNDOCS = 'RCOD';
    const SPECIAL_CONDITIONS_SATURDAY = 'SAT';
    const SPECIAL_CONDITIONS_MONDAY = 'MON';
    const SPECIAL_CONDITIONS_OFFICE = 'OFFICE';

    const PAYER_TYPE_SENDER = 'EXP';
    const PAYER_TYPE_CONSIGNEE = 'DEST';

    private $recipient;
    private $contactPerson;
    private $postalCode;
    private $address;
    private $phone;
    private $email;
    private $serviceType = self::SERVICE_TYPE_NEXTDAY;
    private $envelopeNr = 1;
    private $packageNr = 0;
    private $palletNr = 0;
    private $weight = 1.0;
    private $volume = 0;
    private $payer = self::PAYER_TYPE_SENDER;
    private $cashOnDeliveryType = self::COD_TYPE_CASH;
    private $cashOnDelivery;
    private $bank = '';
    private $iban = '';
    private $declaredValue;
    private $content = 'Parcel content description';
    private $specialConditions = self::SPECIAL_CONDITIONS_NONE;
    private $observations = '';
    private $extra1 = '';
    private $extra2 = '';

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     * @return Shipment
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * @param string $contactPerson
     * @return Shipment
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Shipment
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Shipment
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Shipment
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Shipment
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @param string $serviceType
     * @return Shipment
     */
    public function setServiceType(string $serviceType): Shipment
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @return int
     */
    public function getEnvelopeNr(): int
    {
        return $this->envelopeNr;
    }

    /**
     * @param int $envelopeNr
     * @return Shipment
     */
    public function setEnvelopeNr(int $envelopeNr): Shipment
    {
        $this->envelopeNr = $envelopeNr;
        return $this;
    }

    /**
     * @return int
     */
    public function getPackageNr(): int
    {
        return $this->packageNr;
    }

    /**
     * @param int $packageNr
     * @return Shipment
     */
    public function setPackageNr(int $packageNr): Shipment
    {
        $this->packageNr = $packageNr;
        return $this;
    }

    /**
     * @return int
     */
    public function getPalletNr(): int
    {
        return $this->palletNr;
    }

    /**
     * @param int $palletNr
     * @return Shipment
     */
    public function setPalletNr(int $palletNr): Shipment
    {
        $this->palletNr = $palletNr;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return Shipment
     */
    public function setWeight(float $weight): Shipment
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getVolume(): int
    {
        return $this->volume;
    }

    /**
     * @param int $volume
     * @return Shipment
     */
    public function setVolume(int $volume): Shipment
    {
        $this->volume = $volume;
        return $this;
    }

    /**
     * @return string
     */
    public function getPayer(): string
    {
        return $this->payer;
    }

    /**
     * @param string $payer
     * @return Shipment
     */
    public function setPayer(string $payer): Shipment
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * @return string
     */
    public function getCashOnDeliveryType(): string
    {
        return $this->cashOnDeliveryType;
    }

    /**
     * @param string $cashOnDeliveryType
     * @return Shipment
     */
    public function setCashOnDeliveryType(string $cashOnDeliveryType): Shipment
    {
        $this->cashOnDeliveryType = $cashOnDeliveryType;
        return $this;
    }

    /**
     * @return string
     */
    public function getCashOnDelivery()
    {
        return $this->cashOnDelivery;
    }

    /**
     * @param string $cashOnDelivery
     * @return Shipment
     */
    public function setCashOnDelivery($cashOnDelivery)
    {
        $this->cashOnDelivery = $cashOnDelivery;
        return $this;
    }

    /**
     * @return string
     */
    public function getBank(): string
    {
        return $this->bank;
    }

    /**
     * @param string $bank
     * @return Shipment
     */
    public function setBank(string $bank): Shipment
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     * @return string
     */
    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     * @return Shipment
     */
    public function setIban(string $iban): Shipment
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeclaredValue()
    {
        return $this->declaredValue;
    }

    /**
     * @param string $declaredValue
     * @return Shipment
     */
    public function setDeclaredValue($declaredValue)
    {
        $this->declaredValue = $declaredValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Shipment
     */
    public function setContent(string $content): Shipment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecialConditions(): string
    {
        return $this->specialConditions;
    }

    /**
     * @param string $specialConditions
     * @return Shipment
     */
    public function setSpecialConditions(string $specialConditions): Shipment
    {
        $this->specialConditions = $specialConditions;
        return $this;
    }

    /**
     * @return string
     */
    public function getObservations(): string
    {
        return $this->observations;
    }

    /**
     * @param string $observations
     * @return Shipment
     */
    public function setObservations(string $observations): Shipment
    {
        $this->observations = $observations;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtra1(): string
    {
        return $this->extra1;
    }

    /**
     * @param string $extra1
     * @return Shipment
     */
    public function setExtra1(string $extra1): Shipment
    {
        $this->extra1 = $extra1;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtra2(): string
    {
        return $this->extra2;
    }

    /**
     * @param string $extra2
     * @return Shipment
     */
    public function setExtra2(string $extra2): Shipment
    {
        $this->extra2 = $extra2;
        return $this;
    }
}