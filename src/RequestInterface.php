<?php

namespace RWypior\NemoCourier;

interface RequestInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * Supply apikey
     * @param string $apikey
     */
    public function setApikey(string $apikey);

    /**
     * Get query data
     * @return array
     */
    public function getQuery() : array;

    /**
     * Get post data
     * @return array
     */
    public function getPost() : array;
    
    /**
     * Get requested response class name
     * @return string
     */
    public function getExpectedResponse() : string;
    
    /**
     * Get request url
     * @return string
     */
    public function getRequestUrl() : string;
    
    /**
     * Get request method
     * @return string method
     */
    public function getMethod() : string;
}