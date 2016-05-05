<?php

namespace AppBundle\Entity;

use AppBundle\Validator\Constraint as AppAssert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CreditCard
 *
 * @ORM\Table(name="credit_card")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CreditCardRepository")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class CreditCard
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    const TYPE_AMEX         = 'amex';
    const TYPE_DISCOVER     = 'discover';
    const TYPE_MASTER_CARD  = 'master_card';
    const TYPE_VISA         = 'visa';

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose
     * @Serializer\Type("integer")
     * @Serializer\Groups({"default"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotNull()
     * @Assert\Regex("/^[a-zA-Z]+(\ [a-zA-Z]+)*$/", message="name can only contain letters")
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"default"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=255)
     *
     * @Assert\NotNull()
     * @Assert\Regex("/^\d{4}$/", message="postcode can only contain numbers and 4 characters")
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"default"})
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="credit_card_number", type="string", length=255)
     *
     * @Assert\NotNull()
     * @AppAssert\CreditCardNumber()
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"default"})
     */
    private $creditCardNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"default"})
     * @Serializer\ReadOnly()
     */
    private $type;

    #----------------------------------------------------------------------------------------------
    # Properties accessor
    #----------------------------------------------------------------------------------------------

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CreditCard
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return CreditCard
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set number
     *
     * @param string $creditCardNumber
     *
     * @return CreditCard
     */
    public function setCreditCardNumber($creditCardNumber)
    {
        $this->creditCardNumber = $creditCardNumber;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getCreditCardNumber()
    {
        return $this->creditCardNumber;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return CreditCard
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}

