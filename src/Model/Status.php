<?php

namespace RWypior\NemoCourier\Model;

class Status
{
    const STATUS_DELIVERED = 'Comanda livrata la client';
    const STATUS_REFUSED = 'Comanda refuzata de client';
    const STATUS_NOT_PICKED_UP = 'Manifestat. Nepreluat';

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
        return $this->statusDescription == self::STATUS_DELIVERED;
    }

    public function isRefused(): bool
    {
        return $this->statusDescription == self::STATUS_REFUSED;
    }

    public function isInTransit(): bool
    {
        return !$this->isDelivered() && !$this->isRefused();
    }
}