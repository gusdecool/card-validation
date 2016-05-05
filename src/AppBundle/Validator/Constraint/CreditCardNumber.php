<?php

namespace AppBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Class CreditCardNumber
 * @package AppBundle\Validator\Constraint
 * @Annotation
 */
class CreditCardNumber extends Constraint
{
    
    public $message = 'credit card number is invalid';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'credit_card_number_validator';
    }
}
