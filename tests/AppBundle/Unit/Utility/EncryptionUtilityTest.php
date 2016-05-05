<?php

namespace tests\AppBundle\Unit\Utility;

use AppBundle\Utility\EncryptionUtility;

class EncryptionUtilityTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var EncryptionUtility
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

        $this->utility = new EncryptionUtility('test');
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testEncrypt()
    {
        $this->assertEquals(
            '+P24cXIcklfKOHOuFRkIE3WprB6W11NRZnzg8SJRGoM=',
            $this->utility->encrypt('alpha')
        );
    }

    /**
     * @group unit
     */
    public function testDecrypt()
    {
        $this->assertEquals(
            'alpha',
            $this->utility->decrypt('+P24cXIcklfKOHOuFRkIE3WprB6W11NRZnzg8SJRGoM=')
        );
    }
}
