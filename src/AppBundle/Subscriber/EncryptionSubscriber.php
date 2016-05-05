<?php

namespace AppBundle\Subscriber;

use AppBundle\Annotation\Encrypt;
use AppBundle\Utility\EncryptionUtility;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class EncryptionSubscriber implements EventSubscriber
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @var EncryptionUtility
     */
    private $encryptionUtility;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * EncryptionSubscriber constructor.
     *
     * @param Reader $reader
     * @param EncryptionUtility $encryptionUtility
     */
    public function __construct(Reader $reader, EncryptionUtility $encryptionUtility)
    {
        $this->annotationReader = $reader;
        $this->encryptionUtility = $encryptionUtility;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad, Events::prePersist, Events::preUpdate];
    }

    /**
     * Do decryption when postLoad
     *
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $properties = $this->getAnnotatedProperties($entity);

        if (empty($properties)) {
            return;
        }

        foreach ($properties as $property) {
            $getter = $this->getGetter($property->getName(), $entity);
            $encryptedValue = $entity->$getter();
            $plainValue = $this->encryptionUtility->decrypt($encryptedValue);

            $setter = $this->getSetter($property->getName(), $entity);
            $entity->$setter($plainValue);
        }
    }

    /**
     * Do encryption when prePersist
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->encrypt($args->getEntity());
    }

    /**
     * Do encryption when preUpdate
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->encrypt($args->getEntity());
    }

    #----------------------------------------------------------------------------------------------
    # Private methods
    #----------------------------------------------------------------------------------------------

    /**
     * Encrypt entity
     *
     * @param object $entity
     */
    private function encrypt($entity)
    {
        $properties = $this->getAnnotatedProperties($entity);

        if (empty($properties)) {
            return;
        }

        foreach ($properties as $property) {
            $getter = $this->getGetter($property->getName(), $entity);
            $plainValue = $entity->$getter();
            $encryptedValue = $this->encryptionUtility->encrypt($plainValue);

            $setter = $this->getSetter($property->getName(), $entity);
            $entity->$setter($encryptedValue);
        }
    }

    /**
     * @param object $entity
     *
     * @return \ReflectionProperty[]
     */
    private function getAnnotatedProperties($entity)
    {
        $annotatedProperties = [];
        $properties = ClassUtils::newReflectionObject($entity)->getProperties();

        foreach ($properties as $property) {
            if (null !== $this->annotationReader->getPropertyAnnotation($property, Encrypt::class)) {
                $annotatedProperties[] = $property;
            }
        }

        return $annotatedProperties;
    }

    /**
     * @param string $property
     * @param object $entity
     *
     * @return string|null
     */
    private function getGetter($property, $entity)
    {
        $getter = 'get' . ucfirst($property);
        if (method_exists($entity, $getter)) {
            return $getter;
        }

        return null;
    }

    /**
     * @param string $property
     * @param object $entity
     *
     * @return string|null
     */
    private function getSetter($property, $entity)
    {
        $setter = 'set' . ucfirst($property);
        if (method_exists($entity, $setter)) {
            return $setter;
        }

        return null;
    }
}
