<?php

namespace RWypior\NemoCourier\Request;

use RWypior\NemoCourier\RequestInterface;
use RWypior\NemoCourier\Response\GetLabelResponse;

class GetLabelRequest implements RequestInterface
{
    const TYPE_HTML = 'html';
    const TYPE_PDF = 'pdf';
    const TYPE_IMAGE = 'image'; // not implemented by Nemo yet

    const DEFAULT_TYPE = self::TYPE_PDF;
    const DEFAULT_AWBONLY = true;

    private $code;
    private $awbonly;
    private $type;

    /**
     * GetLabelRequest constructor.
     * @param string $code AWB code
     * @param bool $awbOnly
     * @param string $type see TYPE_ consts
     */
    public function __construct(string $code, bool $awbOnly = self::DEFAULT_AWBONLY, string $type = self::DEFAULT_TYPE)
    {
        $this->code = $code;
        $this->awbonly = $awbOnly;
        $this->type = $type;
    }

    /**
     * @inheritdoc
     */
    public function getQuery() : array
    {
        return [
            'code' => $this->code,
            'awb-only' => $this->awbonly ? 'true' : 'false',
            'type' => $this->type
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPost() : array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function setApikey(string $apikey)
    { }

    /**
     * @inheritdoc
     */
    public function getExpectedResponse() : string
    {
        return GetLabelResponse::class;
    }

    /**
     * @inheritdoc
     */
    public function getRequestUrl() : string
    {
        return 'http://api.nemoexpress.net/v2/label.php';
    }

    /**
     * @inheritdoc
     */
    public function getMethod() : string
    {
        return RequestInterface::METHOD_GET;
    }
}