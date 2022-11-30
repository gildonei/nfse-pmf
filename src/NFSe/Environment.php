<?php

namespace NFSe;

/**
 * Class Environment
 *
 * @package NFSe
 */
class Environment
{
    /**
     * API address
     * @var string
     */
    private $api;

    /**
     * Identify if environment is production
     * @var bool
     */
    private $isProduction;

    /**
     * Environment constructor.
     *
     * @param $api
     * @param $apiQuery
     */
    private function __construct($api)
    {
        $this->api = $api;
    }

    /**
     * @return \NFSe\Environment
     */
    public static function sandbox()
    {
        $api = 'https://nfps-e-hml.pmf.sc.gov.br/api/v1/';

        self::$isProduction = false;

        return new Environment($api);
    }

    /**
     * @return \NFSe\Environment
     */
    public static function production()
    {
        $api = 'https://nfps-e.pmf.sc.gov.br/api/v1/';

        self::$isProduction = true;

        return new Environment($api);
    }

    /**
     * Gets the environment's Api URL
     *
     * @return string the Api URL
     */
    public function getApiUrl()
    {
        return $this->api;
    }

    /**
     * Returns a boolean indicating if actual environment is prodction or not
     *
     * @return bool|null
     */
    public function isProduction()
    {
        return $this->isProduction;
    }
}