<?php

namespace Drupal\module_hero\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Our events subscribe
 */
class HeroInitSubscriber implements EventSubscriberInterface {

    /**
     *
     */
    public function __construct() {

    }

    /**
     * 
     */
    public function onRequest($event) {
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        $events[KernelEvents::REQUEST][] = ['onRequest'];
        return $events;
    }

}