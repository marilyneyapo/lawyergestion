<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPasswordHasher
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if (!$entity instanceof User) {
            return;
        }

        if ($entity->getPassword()) {
            $entity->setPassword(
                $this->passwordEncoder->encodePassword($entity, $entity->getPassword())
            );
        }
    }

    public function preUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if (!$entity instanceof User) {
            return;
        }

        if ($entity->getPassword()) {
            $entity->setPassword(
                $this->passwordEncoder->encodePassword($entity, $entity->getPassword())
            );
        }
    }
}
