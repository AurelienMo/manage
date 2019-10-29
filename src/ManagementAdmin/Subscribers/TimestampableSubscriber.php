<?php

declare(strict_types=1);

/*
 * This file is part of management
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\ManagementAdmin\Subscribers;

use App\Entity\Interfaces\TimestampableInterface;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Class TimestampableSubscriber
 */
class TimestampableSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_UPDATE => 'onUpdate',
        ];
    }

    public function onUpdate(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!$entity instanceof TimestampableInterface) {
            return;
        }

        $entity->setUpdatedAt(new DateTime());

        $event['entity'] = $entity;
    }
}
