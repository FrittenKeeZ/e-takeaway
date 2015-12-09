<?php

namespace Etakeaway;

/**
 * API class for e-takeaway partner functions.
 *
 * @see http://api.e-takeaway.com/V1/Documentation/
 */
class Api
{
    /**
     * E-takeaway API URL.
     *
     * @var string
     */
    const API_URL = 'http://api.e-takeaway.com/v1/';

    /**
     * Last Request object.
     *
     * @var Entity\Request
     */
    protected $request;

    /**
     * Last Response object.
     *
     * @var Entity\Response
     */
    protected $response;

    /**
     * Constructor.
     *
     * @param Entity\Request $request Initial request object, which will be cloned for subsequent calls.
     */
    public function __construct(Entity\Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get last request object.
     *
     * @return Entity\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get last response object.
     *
     * @return Entity\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Dispatches a request to e-takeaway.
     *
     * @param string              $function API function name.
     * @param Entity\AbstractData $data     Data object.
     *
     * @return Entity\Response
     */
    public function dispatch($function, Entity\AbstractData $data)
    {
        // Clone the previous request, retaining necessary properties.
        $this->request = clone $this->request;
        $this->request
            ->setFunction($function)
            ->setData($data)
        ;

        $ch = curl_init(self::API_URL);
        curl_setopt_array($ch, $this->formatCurlOptions($this->request));
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * Format cURL options.
     *
     * @param Entity\Request $request
     *
     * @return array
     */
    protected function formatCurlOptions(Entity\Request $request)
    {
        return array(
            \CURLOPT_HEADER => false,
            \CURLOPT_RETURNTRANSFER => true,
            \CURLOPT_POST => true,
            // Pass request data as a param string instead of an array to prevent encoding which breaks the API endpoint.
            \CURLOPT_POSTFIELDS => 'jsonrequest=' . json_encode($request),
        );
    }
}
