<?php

namespace NFSe\Entity;

/**
 * Class NFSeError
 *
 * @package NFSe\Request
 */
class NFSeError
{
    /**
     * Error code from NFSe API
     * @var int
     */
    private $code;

    /**
     * Error message from NFSe API
     * @var string
     */
    private $message;

    /**
     * Constructor
     *
     * @param $message
     * @param $code
     */
    public function __construct($message, $code)
    {
        $this->setCode($code);
        $this->setMessage($message);
    }

    /**
     * Return the error code from NFSe API
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Define the error code from NFSe API
     * @param int $code
     * @return NFSeError
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Return the error message from NFSe API
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Define the error message from NFSe API
     * @param string $message
     * @return NFSeError
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
