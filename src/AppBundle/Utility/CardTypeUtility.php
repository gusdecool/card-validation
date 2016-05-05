<?php

namespace AppBundle\Utility;

use AppBundle\Entity\CreditCard;

class CardTypeUtility
{

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param string $number credit card number
     * @return null|string
     */
    public function getCardType($number)
    {
        if ($this->isAmex($number) === true) {
            return CreditCard::TYPE_AMEX;
        }

        if ($this->isDiscover($number) === true) {
            return CreditCard::TYPE_DISCOVER;
        }

        if ($this->isMasterCard($number) === true) {
            return CreditCard::TYPE_MASTER_CARD;
        }

        if ($this->isVisa($number) === true) {
            return CreditCard::TYPE_VISA;
        }

        return null;
    }

    /**
     * Check if credit card type is amex
     * - Begin with 34 or 37
     * - Number length 15
     *
     * @param string $number credit card number
     * @return bool
     */
    public function isAmex($number)
    {
        if (preg_match('/(^34|^37)[0-9]{13}$/s', $number) === 1) {
            return true;
        }

        return false;
    }

    /**
     * Check if credit card type is discover
     * - Begin with 6011
     * - Number length 16
     *
     * @param string $number credit card number
     * @return bool
     */
    public function isDiscover($number)
    {
        if (preg_match('/6011[0-9]{12}$/s', $number) === 1) {
            return true;
        }

        return false;
    }

    /**
     * Check if credit card type is master card
     * - Begin with 51 or 55
     * - Number length 16
     *
     * @param string $number credit card number
     * @return bool
     */
    public function isMasterCard($number)
    {
        if (preg_match('/(^51|^55)[0-9]{14}$/s', $number) === 1) {
            return true;
        }

        return false;
    }

    /**
     * Check if credit card type is visa
     * - Begin with 4
     * - Number length 13 or 16
     *
     * @param string $number credit card number
     * @return bool
     */
    public function isVisa($number)
    {
        if (preg_match('/^4([0-9]{12}|[0-9]{15})$/s', $number) === 1) {
            return true;
        }

        return false;
    }
}
