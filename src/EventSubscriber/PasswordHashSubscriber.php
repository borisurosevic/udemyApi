<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordHashSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents(){
        return[
            KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function hashPassword(ViewEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if(!$user instanceof User || Request::METHOD_POST !== $method){
            return;
        }

        // It is an User, we need to hash password here
        $user->setPassword(
            $this->passwordEncoder->hashPassword($user, $user->getPassword())
        );
    }
}