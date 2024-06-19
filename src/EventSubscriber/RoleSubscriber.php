<?php 

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class RoleSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    public function onKernelController(ControllerEvent $event)
    {
        $user = $this->security->getUser();
        $role = '';

        if ($user) {
            if ($this->security->isGranted('ROLE_DEMANDEUR')) {
                $role = 'ROLE_DEMANDEUR';
            } elseif ($this->security->isGranted('ROLE_ENTREPRISE')) {
                $role = 'ROLE_ENTREPRISE';
            }
        }

        $request = $event->getRequest();
        $request->attributes->set('role', $role);
    }
}
