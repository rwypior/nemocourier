<?php

namespace RWypior\NemoCourier\Response;

use RWypior\NemoCourier\Exception\CourierException;
use RWypior\NemoCourier\Model\Status;
use RWypior\NemoCourier\ResponseInterface;

class CheckStatusResponse implements ResponseInterface
{
    private $statuses;

    /**
     * CheckStatusResponse constructor.
     * @param Status[] $statuses
     */
    protected function __construct(array $statuses)
    {
        $this->statuses = [];

        foreach($statuses as $status)
        {
            $this->statuses[$status->getAwb()] = $status;
        }
    }

    public static function createResponse($data) : ResponseInterface
    {
        $json = json_decode($data);

        if (isset($json->isError) && $json->isError)
        {
            $msg = implode('; ', $json->messages);
            throw new CourierException('Request failed: ' . $msg, CourierException::EXCCODE_REQUEST_FAILED);
        }

        $statuses = array_map(function($e) {
            return new Status($e->awb, $e->status, new \DateTime($e->date));
        }, $json->data);

        return new CheckStatusResponse($statuses);
    }

    /**
     * Get all statuses
     * @return Status[]
     */
    public function getStatuses() : array
    {
        return array_values($this->statuses);
    }

    /**
     * Get status for specific AWB
     * @param string $awb
     * @return Status|NULL
     */
    public function getStatusForAwb(string $awb)
    {
        return isset($this->statuses[$awb]) ? $this->statuses[$awb] : NULL;
    }

    public function isDelivered() : bool
    {
        $lastStatus = $this->getLastStatus();

        if ($lastStatus)
            return $lastStatus->getStatusDescription() == Status::STATUS_DELIVERED;

        return false;
    }

    public function isRefused() : bool
    {
        $lastStatus = $this->getLastStatus();

        if ($lastStatus)
            return $lastStatus->getStatusDescription() == Status::STATUS_REFUSED;

        return false;
    }

    public function isInTransit() : bool
    {
        return !$this->isDelivered() && !$this->isRefused();
    }

    public function hasAnyStatus() : bool
    {
        return (bool)count($this->statuses);
    }

    /**
     * @return Status|null
     */
    public function getLastStatus()
    {
        return $this->hasAnyStatus() ? $this->statuses[count($this->statuses) - 1] : NULL;
    }
}