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
     * @return Environment
     */
    public static function sandbox()
    {
        $api = 'https://nfps-e-hml.pmf.sc.gov.br/api/v1/';

        return new Environment($api);
    }

    /**
     * @return Environment
     */
    public static function production()
    {
        $api = 'https://nfps-e.pmf.sc.gov.br/api/v1/';

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
}