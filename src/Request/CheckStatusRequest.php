<?php

namespace RWypior\NemoCourier\Request;

use RWypior\NemoCourier\RequestInterface;
use RWypior\NemoCourier\Response\CheckStatusResponse;

class CheckStatusRequest implements RequestInterface
{
    private $codes;
    private $apikey;

    /**
     * @param string[] $codes array of AWB codes to check statuses for
     */
    public function __construct(array $codes)
    {
        $this->codes = $codes;
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
        $request = [
            ['awb' => implode(',', $this->codes)]
        ];

        return [
            'data' => json_encode($request)
        ];
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
        return CheckStatusResponse::class;
    }

    /**
     * @inheritdoc
     */
    public function getRequestUrl() : string
    {
        return 'http://api.nemoexpress.net/v2/statusawb.php';
    }

    /**
     * @inheritdoc
     */
    public function getMethod() : string
    {
        return RequestInterface::METHOD_POST;
    }
}