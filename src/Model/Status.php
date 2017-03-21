<?php

namespace RWypior\NemoCourier\Model;

class Status
{
    const STATUS_DELIVERED = 'Comanda livrata la client';
    const STATUS_REFUSED = 'Comanda refuzata de client';

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
}