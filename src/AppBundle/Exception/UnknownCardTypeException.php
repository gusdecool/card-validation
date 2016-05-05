<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class UnknownCardTypeException extends \RuntimeException implements HttpExceptionInterface
{

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------
    
    /**
     * UnknownCardTypeException constructor.
     */
    public function __construct()
    {
        parent::__construct("unknown credit card type");
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getStatusCode()
    {
        return 400;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return [];
    }
}
