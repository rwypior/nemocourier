<?php

namespace RWypior\NemoCourier;

use RWypior\NemoCourier\Exception\CourierException;

/**
 * Nemo courier client
 * @package RWypior\NemoCourier
 */
class Nemo
{
    /** @var \GuzzleHttp\Client $guzzle */
    private $guzzle;
    private $apikey;

    /**
     * Nemo constructor.
     * @param string $apikey nemo apikey
     */
    public function __construct(string $apikey)
    {
        $this->guzzle = new \GuzzleHttp\Client;
        $this->apikey = $apikey;
    }

    private function createOptionsArray(RequestInterface $request) : array
    {
        $request->setApikey($this->apikey);

        $options = [
            'query' => $request->getQuery(),
            'form_params' => $request->getPost()
        ];

        return $options;
    }
    
    /**
     * Send request
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws CourierException
     */
    public function sendRequest(RequestInterface $request) : ResponseInterface
    {
        try
        {
            $options = $this->createOptionsArray($request);
            $res = $this->guzzle->request($request->getMethod(), $request->getRequestUrl(), $options);
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            $code = $ex->getResponse()->getStatusCode();
            throw new CourierException("Request failed with code $code", CourierException::EXCCODE_REQUEST_FAILED, $ex);
        }
        catch (\GuzzleHttp\Exception\RequestException $ex)
        {
            throw new CourierException('Could not connect to courier API', CourierException::EXCCODE_CONNECTION_FAILED, $ex);
        }
        catch (\Exception $ex)
        {
            throw new CourierException('Could not add send Nemo request', CourierException::EXCCODE_UNKNOWN_ERROR, $ex);
        }
                
        $expectedResponseClass = $request->getExpectedResponse();
        return $expectedResponseClass::createResponse($res->getBody()->getContents());
    }
}