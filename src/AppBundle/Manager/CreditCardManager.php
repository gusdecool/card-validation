<?php

namespace AppBundle\Manager;

use AppBundle\Entity\CreditCard;
use AppBundle\Exception\ValidationFailedException;
use AppBundle\Repository\CreditCardRepository;
use AppBundle\Utility\CardTypeUtility;
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

    /**
     * @var CardTypeUtility
     */
    private $cardTypeUtility;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * CreditCardManager constructor.
     *
     * @param CreditCardRepository $repository
     * @param ValidatorInterface $validator
     * @param CardTypeUtility $cardTypeUtility
     */
    public function __construct(
        CreditCardRepository $repository,
        ValidatorInterface $validator,
        CardTypeUtility $cardTypeUtility
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->cardTypeUtility = $cardTypeUtility;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param CreditCard $creditCard
     * @throws ValidationFailedException
     */
    public function save(CreditCard $creditCard)
    {
        $errors = $this->validator->validate($creditCard);
        
        if ($errors->count() > 0) {
            throw new ValidationFailedException($errors);
        }
        
        $creditCard->setType($this->cardTypeUtility->getCardType($creditCard->getCreditCardNumber()));
        $this->repository->save($creditCard);
    }
}
