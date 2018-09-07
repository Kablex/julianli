<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Requests\Contact;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Messenger\MessageBusInterface;

class ContactSubscriber implements EventSubscriberInterface
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function contact(GetResponseForControllerResultEvent $event): void
    {
        $request = $event->getRequest();

        if ('api_contacts_post_collection' !== $request->attributes->get('_route')) {
            return;
        }

        $this->messageBus->dispatch($event->getControllerResult());

        $event->setResponse(new JsonResponse(null, 204));
    }

    public static function getSubscribedEvents(): array
    {
        return [
           'kernel.view' => ['contact', EventPriorities::POST_VALIDATE],
        ];
    }
}
