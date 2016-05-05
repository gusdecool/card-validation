<?php

namespace AppBundle\Manager;

use AppBundle\Entity\CreditCard;
use AppBundle\Exception\ValidationFailedException;
use AppBundle\Repository\CreditCardRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreditCardManager
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var CreditCardRepository
     */
    private $repository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * CreditCardManager constructor.
     * 
     * @param CreditCardRepository $repository
     * @param ValidatorInterface $validator
     */
    public function __construct(CreditCardRepository $repository, ValidatorInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param CreditCard $creditCard
     */
    public function save(CreditCard $creditCard)
    {
        $errors = $this->validator->validate($creditCard);
        
        if ($errors->count() > 0) {
            throw new ValidationFailedException($errors);
        }
        
        $this->repository->save($creditCard);
    }
}
