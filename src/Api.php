<?php

namespace Etakeaway;

use Etakeaway\Entity\DataBasic;
use Etakeaway\Entity\DataInterface;
use Etakeaway\Entity\Request;
use Etakeaway\Entity\Response;

/**
 * API class for e-takeaway integration.
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
    public function __construct(Request $request)
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
     * @param string               $function API function name.
     * @param Entity\DataInterface $data     DataInterface object. Defaults to null.
     *
     * @return Entity\Response
     */
    public function dispatch($function, DataInterface $data = null)
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

        return $this->convertResponseData($response);
    }

    /**
     * Checks whether the calling client's reported version number is still supported by the API.
     *
     * @see http://api.e-takeaway.com/V1/Documentation/?p=F_CheckVersion
     *
     * @return Entity\Response
     */
    public function checkVersion()
    {
        return $this->dispatch('CheckVersion');
    }

    /**
     * Format cURL options.
     *
     * @param Entity\Request $request
     *
     * @return array
     */
    protected function formatCurlOptions(Request $request)
    {
        return [
            \CURLOPT_HEADER => false,
            \CURLOPT_RETURNTRANSFER => true,
            \CURLOPT_POST => true,
            // Pass request data as a param string instead of an array to prevent encoding which breaks the API endpoint.
            \CURLOPT_POSTFIELDS => 'jsonrequest=' . json_encode($request),
            // Eliminate the 'Expect' header to avoid sudden 417 Expectation Failed errors.
            \CURLOPT_HTTPHEADER => ['Expect:'],
        ];
    }

    /**
     * Converts a primitive stdClass response data object to a Response object.
     *
     * @param \stdClass $responseData
     *
     * @return Entity\Response
     */
    private function convertResponseData(\stdClass $responseData)
    {
        $response = new Response($responseData->Status, $responseData->StatusCode);
        $response
            ->setStatusMessage($responseData->StatusMessage)
            ->setLanguage($responseData->Language)
            ->setTestMode($responseData->TestMode)
            ->setFunction($responseData->Function)
        ;

        // Set error message if it exists.
        if (isset($responseData->ErrorMessage)) {
            $response->setErrorMessage($responseData->ErrorMessage);
        }

        // Set data if it exists.
        if (isset($responseData->Data)) {
            $convertMethod = 'convert' . $responseData->Function . 'Data';
            if (method_exists($this, $convertMethod)) {
                $response->setData($this->$convertMethod($responseData->Data));
            } else {
                $response->setData(new DataBasic($responseData->Data));
            }
        }

        return $response;
    }
}
