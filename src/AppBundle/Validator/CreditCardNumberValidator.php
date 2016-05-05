<?php

namespace AppBundle\Validator;

use AppBundle\Utility\AlgorithmUtility;
use AppBundle\Utility\CardTypeUtility;
use AppBundle\Validator\Constraint\CreditCardNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CreditCardNumberValidator extends ConstraintValidator
{
    
    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var AlgorithmUtility
     */
    private $algorithmUtility;

    /**
     * @var CardTypeUtility
     */
    private $cardTypeUtility;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * CreditCardNumberValidator constructor.
     * 
     * @param AlgorithmUtility $algorithmUtility
     * @param CardTypeUtility $cardTypeUtility
     */
    public function __construct(AlgorithmUtility $algorithmUtility, CardTypeUtility $cardTypeUtility)
    {
        $this->algorithmUtility = $algorithmUtility;
        $this->cardTypeUtility = $cardTypeUtility;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     *
     * @param CreditCardNumber $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->cardTypeUtility->getCardType($value) === null ||
            $this->algorithmUtility->isValidLuhnAlgorithm($value) === false
        ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
