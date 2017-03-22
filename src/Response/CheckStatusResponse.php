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
            $code = isset($e->awb) ? $e->awb : $e->barcode;
            return new Status($code, $e->status, new \DateTime($e->date));
        }, $json->data);

        return new CheckStatusResponse($statuses);
    }

    /**
     * Get all statuses
     * @return Status[]
     */
    public function getStatuses() : array
    {
        return $this->statuses;
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

    public function isDelivered(string $awb) : bool
    {
        if ($status = $this->getStatusForAwb($awb))
            return $status->isDelivered();

        return false;
    }

    public function isRefused(string $awb) : bool
    {
        if ($status = $this->getStatusForAwb($awb))
            return $status->isRefused();

        return false;
    }

    public function isInTransit(string $awb) : bool
    {
        if ($status = $this->getStatusForAwb($awb))
            return $status->isInTransit();

        return false;
    }
}