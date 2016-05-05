<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CreditCard;
use Doctrine\ORM\EntityRepository;

class CreditCardRepository extends EntityRepository
{

    /**
     * @param CreditCard $creditCard
     */
    public function save(CreditCard $creditCard)
    {
        $this->getEntityManager()->persist($creditCard);
    }
}
