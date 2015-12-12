<?php

namespace Etakeaway\Entity;

/**
 * Request.
 *
 * @implements \JsonSerializable
 */
class Request implements \JsonSerializable
{
    /**
     * Website ID that identifies the website and database to connect to.
     *
     * @see http://api.e-takeaway.com/V1/Documentation/?p=P_WebsiteIdList
     *
     * @var string
     */
    private $website;

    /**
     * Secret key for client authentication.
     *
     * @var string
     */
    private $clientCode;

    /**
     * The client application's current version number.
     *
     * @var float
     */
    private $clientVersion = 1.3;

    /**
     * The ISO language code of the client's chosen display language.
     *
     * @var string
     */
    private $language;

    /**
     * Test mode flag for the API call, which may change the function's behavior.
     *
     * @var bool
     */
    private $testMode = false;

    /**
     * The current user's authentication token for those functions that require user authentication.
     * Most functions don't require user authentication.
     *
     * @var string
     */
    private $userToken = '';

    /**
     * The name of the called API function.
     *
     * @var string
     */
    private $function;

    /**
     * A DataInterface object that needs to be passed on to the called API function.
     *
     * @var DataInterface
     */
    private $data;

    /**
     * Constructor.
     *
     * @param string $website    Website ID.
     * @param string $clientCode Secret client key.
     * @param string $language   ISO language code. Defaults to 'en-US'.
     */
    public function __construct($website, $clientCode, $language = 'en-US')
    {
        $this->website = $website;
        $this->clientCode = $clientCode;
        $this->language = $language;
    }

    /**
     * Get website ID.
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Get client code.
     *
     * @return string
     */
    public function getClientCode()
    {
        return $this->clientCode;
    }

    /**
     * Set client version.
     *
     * @param float $clientVersion
     *
     * @return Request
     */
    public function setClientVersion($clientVersion)
    {
        $this->clientVersion = $clientVersion;

        return $this;
    }

    /**
     * Get client version.
     *
     * @return float
     */
    public function getClientVersion()
    {
        return $this->clientVersion;
    }

    /**
     * Set ISO language code.
     *
     * @param string $language
     *
     * @return Request
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
     * @return Request
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
     * Set user token.
     *
     * @param string $userToken
     *
     * @return Request
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;

        return $this;
    }

    /**
     * Get user token.
     *
     * @return string
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * Set function.
     *
     * @param string $function
     *
     * @return Request
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
     * @return Request
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

    /**
     * Clone callback method.
     * Resets 'function' and 'data' properties.
     */
    public function __clone() {
        $this->function = null;
        $this->data = null;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array(
            'Website' => $this->website,
            'ClientCode' => $this->clientCode,
            'ClientVersion' => $this->clientVersion,
            'Language' => $this->language,
            'TestMode' => $this->testMode,
            'UserToken' => $this->userToken,
            'Function' => $this->function,
            'Data' => $this->data,
        );
    }
}
