<?php

namespace RWypior\NemoCourier\Response;

use RWypior\NemoCourier\ResponseInterface;

class GetLabelResponse implements ResponseInterface
{
    private $content;

    protected function __construct($content)
    {
        $this->content = $content;
    }

    public static function createResponse($data) : ResponseInterface
    {
        return new GetLabelResponse($data);
    }

    /**
     * Get label data
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }
}