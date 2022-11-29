<?php

namespace NFSe\Exception;

use NFSe\Entity\NFSeError;

/**
 * Class NFSeRequestException
 *
 * @package NFSe\Exception
 */
class NFSeRequestException extends \Exception
{
    /**
     * Entity of NFSeError
     * @var NFSeError
     */
    private $NFSeError;

    /**
     * NFSeRequestException constructor.
     *
     * @param string $message
     * @param int    $code
     * @param null   $previous
     */
    public function __construct($message, $code, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setNFSeError(new NFSeError($message, $code));
    }

    /**
     * Return the NFSe error object
     * @return NFSeError
     */
    public function getNFSeError()
    {
        return $this->NFSeError;
    }

    /**
     * Define the NFSe error
     * @param NFSeError $NFSeError
     * @return $this
     */
    public function setNFSeError(NFSeError $NFSeError)
    {
        $this->NFSeError = $NFSeError;

        return $this;
    }
}