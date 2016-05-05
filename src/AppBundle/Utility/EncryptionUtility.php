<?php

namespace AppBundle\Utility;

class EncryptionUtility
{

    #------------------------------------------------------------------------------------------------------
    # Properties
    #------------------------------------------------------------------------------------------------------

    /**
     * @var string
     */
    private $secureKey;

    /**
     * @var string
     */
    private $iv;

    #------------------------------------------------------------------------------------------------------
    # Magic methods
    #------------------------------------------------------------------------------------------------------

    /**
     * EncryptionUtility constructor.
     *
     * @param string $aesKey
     */
    public function __construct($aesKey)
    {
        $this->secureKey = hash('sha256', $aesKey, true);
        $this->iv = mcrypt_create_iv(32);
    }

    #------------------------------------------------------------------------------------------------------
    # Public methods
    #------------------------------------------------------------------------------------------------------

    /**
     * @param string $input
     * @return string
     */
    public function encrypt($input)
    {
        return base64_encode(
            mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->secureKey, $input, MCRYPT_MODE_ECB, $this->iv)
        );
    }

    /**
     * @param string $input
     * @return string
     */
    public function decrypt($input)
    {
        return trim(
            mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->secureKey, base64_decode($input), MCRYPT_MODE_ECB, $this->iv)
        );
    }
}
