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

use App\Domain\Common\Helpers\PropertyAccessorHelper;
use App\Domain\Common\Helpers\SlugifyHelper;
use App\Entity\Interfaces\SluggableInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Class SluggableSubscriber
 */
class SluggableSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_PERSIST => 'defineSlug',
            EasyAdminEvents::PRE_UPDATE => 'defineSlug',
        ];
    }

    public function defineSlug(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!$entity instanceof SluggableInterface) {
            return;
        }

        $propertyValue = PropertyAccessorHelper::getProperty($entity, $entity->getPropertyForSlug());
        $slug = SlugifyHelper::slugify($propertyValue);

        $entity->setSlug($slug);

        $event['entity'] = $entity;
    }
}
