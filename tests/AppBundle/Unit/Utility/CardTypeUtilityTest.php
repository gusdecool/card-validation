<?php

namespace tests\AppBundle\Unit\Utility;

use AppBundle\Entity\CreditCard;
use AppBundle\Utility\CardTypeUtility;

class CardTypeUtilityTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var CardTypeUtility
     */
    private $utility;

    #----------------------------------------------------------------------------------------------
    # Setup
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->utility = new CardTypeUtility();
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testIsAmex()
    {
        $this->assertTrue($this->utility->isAmex('343456789012345')); // match
        $this->assertTrue($this->utility->isAmex('373456789012345')); // match

        $this->assertFalse($this->utility->isAmex('34345678901234')); // length not 15
        $this->assertFalse($this->utility->isAmex('393456789012345')); // not start with 34 or 37 
    }

    /**
     * @group unit
     */
    public function testIsDiscover()
    {
        $this->assertTrue($this->utility->isDiscover('6011567890123456')); // match

        $this->assertFalse($this->utility->isDiscover('60115678901234567')); // length not 16
        $this->assertFalse($this->utility->isDiscover('6012567890123456')); // not start with 6011
    }

    /**
     * @group unit
     */
    public function testIsMasterCard()
    {
        $this->assertTrue($this->utility->isMasterCard('5134567890123456')); // match
        $this->assertTrue($this->utility->isMasterCard('5534567890123456')); // match

        $this->assertFalse($this->utility->isMasterCard('51345678901234567')); // length not 16
        $this->assertFalse($this->utility->isMasterCard('5234567890123456')); // not start with 51 or 55
    }

    /**
     * @group unit
     */
    public function testIsVisa()
    {
        $this->assertTrue($this->utility->isVisa('4234567890123')); // match
        $this->assertTrue($this->utility->isVisa('4234567890123456')); // match

        $this->assertFalse($this->utility->isVisa('42345678901234')); // length not 13 or 16
        $this->assertFalse($this->utility->isVisa('1234567890123')); // not start with 4
    }

    /**
     * @group unit
     */
    public function testGetCardType()
    {
        $this->assertEquals(CreditCard::TYPE_AMEX, $this->utility->getCardType('343456789012345'));
        $this->assertEquals(CreditCard::TYPE_DISCOVER, $this->utility->getCardType('6011567890123456'));
        $this->assertEquals(CreditCard::TYPE_MASTER_CARD, $this->utility->getCardType('5134567890123456'));
        $this->assertEquals(CreditCard::TYPE_VISA, $this->utility->getCardType('4234567890123'));
        $this->assertEquals(null, $this->utility->getCardType('1234567890123456'));
    }
}
