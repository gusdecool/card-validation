<?php

namespace tests\AppBundle\Unit\Utility;

use AppBundle\Utility\AlgorithmUtility;

class AlgorithmUtilityTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var AlgorithmUtility
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

        $this->utility = new AlgorithmUtility();
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testIsAmex()
    {
        // sample from docs
        $this->assertTrue($this->utility->isValidLuhnAlgorithm('4408041234567893'));
        $this->assertFalse($this->utility->isValidLuhnAlgorithm('4417123456789112'));

        // sample from wiki
        $this->assertFalse($this->utility->isValidLuhnAlgorithm('79927398710'));
        $this->assertFalse($this->utility->isValidLuhnAlgorithm('79927398711'));
        $this->assertFalse($this->utility->isValidLuhnAlgorithm('79927398712'));
        $this->assertTrue($this->utility->isValidLuhnAlgorithm('79927398713'));
        $this->assertFalse($this->utility->isValidLuhnAlgorithm('79927398714'));
        $this->assertFalse($this->utility->isValidLuhnAlgorithm('79927398715'));
        $this->assertFalse($this->utility->isValidLuhnAlgorithm('79927398716'));

        // sample from various website
        $this->assertTrue($this->utility->isValidLuhnAlgorithm('4027599893556649'));
        $this->assertTrue($this->utility->isValidLuhnAlgorithm('5286634662696236'));
        $this->assertTrue($this->utility->isValidLuhnAlgorithm('343535810456377'));
        $this->assertTrue($this->utility->isValidLuhnAlgorithm('5543694884910699'));
    }
}
