<?php

namespace RWypior\NemoCourier\Model;

class Status
{
    const STATUS_LIST_DELIVERED = [
        'Livrat la destinatar',
        'Comanda livrata la client'
    ];

    const STATUS_LIST_REFUSED = [
        'Comanda refuzata de client',
        'Refuzata de client',
        'Returnat'
    ];

    const STATUS_LIST_INPROGRESS = [
    ];

    private $awb;
    private $statusDescription;
    private $date;

    public function __construct(string $awb, string $statusDescription, \DateTime $date)
    {
        $this->awb = $awb;
        $this->statusDescription = $statusDescription;
        $this->date = $date;
    }

    /**
     * Code of AWB that the status corresponds to
     * @return string
     */
    public function getAwb(): string
    {
        return $this->awb;
    }

    /**
     * Status description
     * @return string
     */
    public function getStatusDescription(): string
    {
        return $this->statusDescription;
    }

    /**
     * Status date
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function isDelivered(): bool
    {
        return isset(array_flip(self::STATUS_LIST_DELIVERED)[$this->statusDescription]);
    }

    public function isRefused(): bool
    {
        return isset(array_flip(self::STATUS_LIST_REFUSED)[$this->statusDescription]);
    }

    public function isInTransit(): bool
    {
        return !$this->isDelivered() && !$this->isRefused();
    }
}