<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationFailedException extends \RuntimeException implements HttpExceptionInterface
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * List of validation errors.
     *
     * @var ConstraintViolationListInterface
     */
    private $validationErrors = [];

    #----------------------------------------------------------------------------------------------
    # Constructor
    #----------------------------------------------------------------------------------------------

    /**
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        parent::__construct($this->compileMessage($errors));

        $this->validationErrors = $errors;
    }

    #----------------------------------------------------------------------------------------------
    # Public Methods
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

    #----------------------------------------------------------------------------------------------
    # Private Methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param ConstraintViolationListInterface|ConstraintViolationInterface[] $errors
     * @return string
     */
    private function compileMessage(ConstraintViolationListInterface $errors)
    {
        $messages = [];

        foreach ($errors as $value) {
            $messages[] = sprintf('%s: %s', $value->getPropertyPath(), $value->getMessage());
        }

        return implode(", ", $messages);
    }
}
