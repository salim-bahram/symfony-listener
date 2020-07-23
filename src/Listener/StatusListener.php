<?php

namespace App\Listener;

use App\Status\Status;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class StatusListener
{
    private $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }
    
    public function isOpen(): bool
    {
        $now  = new \DateTime();
        $hour = (int) $now->format('H');
        $day  = $now->format('l');

        return (($day != 'Saturday' && $day != 'Sunday') && ($hour >= 8 && $hour < 18));
    }

    public function defineStatus(ResponseEvent $event): ?Response
    {
        if (!$event->isMasterRequest()) {
            return null;
        }

        $response = $event->getResponse();

        if ($this->isOpen()) {
            $response = $event->setResponse($this->status->pageOpened($response));
        }
        else {
            $response = $event->setResponse($this->status->pageClosed($response));
        }

        return $response;
    }
}