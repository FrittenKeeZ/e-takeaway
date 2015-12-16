<?php

namespace Etakeaway\Entity;

/**
 * Response.
 *
 * @final
 */
final class Response
{
    /**
     * Tells whether the call was Successful (true) or Failed (false).
     *
     * @var bool
     */
    private $status;

    /**
     * Status message enumerator value.
     *
     * @see http://api.e-takeaway.com/V1/Documentation/?p=P_StatusCodes
     *
     * @var int
     */
    private $statusCode;

    /**
     * The status message enumerator value as text.
     *
     * @var string
     */
    private $statusMessage;

    /**
     * Additional error message as verbose text.
     *
     * @var string
     */
    private $errorMessage;

    /**
     * The localization language the API used to create the output content by the function call.
     *
     * @var string
     */
    private $language;

    /**
     * Tells whether the call was made in test mode.
     *
     * @var bool
     */
    private $testMode;

    /**
     * The name of the called API function.
     *
     * @var string
     */
    private $function;

    /**
     * A DataInterface object that is returned by the called API function.
     *
     * @var DataInterface
     */
    private $data;

    /**
     * Constructor.
     *
     * @param bool $status     If the call was successful (true) or failed (false).
     * @param int  $statusCode Status message enumerator value.
     */
    public function __construct($status, $statusCode)
    {
        $this->status = $status;
        $this->statusCode = $statusCode;
    }

    /**
     * Get status.
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set status message.
     *
     * @param string $statusMessage
     *
     * @return Response
     */
    public function setStatusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;

        return $this;
    }

    /**
     * Get status message.
     *
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * Set error message.
     *
     * @param string $errorMessage
     *
     * @return Response
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * Get error message.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set ISO language code.
     *
     * @param string $language
     *
     * @return Response
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get ISO language code.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set test mode.
     *
     * @param bool $testMode
     *
     * @return Response
     */
    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;

        return $this;
    }

    /**
     * Get test mode.
     *
     * @return bool
     */
    public function getTestMode()
    {
        return $this->testMode;
    }

    /**
     * Set function.
     *
     * @param string $function
     *
     * @return Response
     */
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function.
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set data.
     *
     * @param DataInterface $data
     *
     * @return Response
     */
    public function setData(DataInterface $data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return DataInterface
     */
    public function getData()
    {
        return $this->data;
    }
}
