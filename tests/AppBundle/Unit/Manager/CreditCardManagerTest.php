<?php

namespace tests\AppBundle\Unit\Manager;

use AppBundle\Entity\CreditCard;
use AppBundle\Manager\CreditCardManager;
use AppBundle\Repository\CreditCardRepository;
use AppBundle\Utility\CardTypeUtility;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreditCardManagerTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var CreditCardManager
     */
    private $manager;

    /**
     * @var CreditCardRepository|ObjectProphecy
     */
    private $repository;

    /**
     * @var ValidatorInterface|ObjectProphecy
     */
    private $validator;

    /**
     * @var CardTypeUtility|ObjectProphecy
     */
    private $cardTypeUtility;

    /**
     * @var CreditCard|ObjectProphecy
     */
    private $creditCard;

    /**
     * @var ConstraintViolationListInterface|ObjectProphecy
     */
    private $violationList;

    #----------------------------------------------------------------------------------------------
    # Setup
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->prophesize(CreditCardRepository::class);
        $this->validator = $this->prophesize(ValidatorInterface::class);
        $this->cardTypeUtility = $this->prophesize(CardTypeUtility::class);

        $this->manager = new CreditCardManager(
            $this->repository->reveal(),
            $this->validator->reveal(),
            $this->cardTypeUtility->reveal()
        );

        $this->creditCard = $this->prophesize(CreditCard::class);
        $this->violationList = $this->prophesize(ConstraintViolationListInterface::class);
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testSave()
    {
        // validation
        $this->validator->validate($this->creditCard->reveal())->shouldBeCalledTimes(1)
            ->willReturn($this->violationList->reveal());
        $this->violationList->count()->shouldBeCalledTimes(1)->willReturn(0);

        // assign credit card type
        $this->creditCard->getCreditCardNumber()->shouldBeCalledTimes(1)->willReturn('343456789012345');
        $this->cardTypeUtility->getCardType('343456789012345')->shouldBeCalledTimes(1)
            ->willReturn(CreditCard::TYPE_AMEX);
        $this->creditCard->setType(CreditCard::TYPE_AMEX)->shouldBeCalledTimes(1);
        
        // save
        $this->repository->save($this->creditCard->reveal())->shouldBeCalledTimes(1);

        $this->manager->save($this->creditCard->reveal());
    }

    /**
     * @group unit
     * @expectedException \AppBundle\Exception\ValidationFailedException
     */
    public function testSaveThrowException()
    {        
        // validation
        $this->validator->validate($this->creditCard->reveal())->shouldBeCalled()->willReturn($this->violationList->reveal());
        $this->violationList->count()->shouldBeCalledTimes(1)->willReturn(1);
        $this->violationList->rewind()->shouldBeCalled();
        $this->violationList->valid()->shouldBeCalled();

        $this->manager->save($this->creditCard->reveal());
    }
}
