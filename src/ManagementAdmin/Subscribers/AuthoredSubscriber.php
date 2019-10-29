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

use App\Entity\Interfaces\AuthoredInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AuthoredSubscriber
 */
class AuthoredSubscriber implements EventSubscriberInterface
{
    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * AuthoredSubscriber constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        TokenStorageInterface $tokenStorage
    ) {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_PERSIST => 'onUpdateAuthored',
            EasyAdminEvents::PRE_UPDATE => 'onUpdateAuthored',
        ];
    }

    public function onUpdateAuthored(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!$entity instanceof AuthoredInterface) {
            die('vbntm');
            return;
        }

        if (is_null($this->tokenStorage->getToken()) ||
            (!$this->tokenStorage->getToken()->getUser() instanceof UserInterface)
        ) {
            return;
        }

        $entity->setUpdatedBy($this->tokenStorage->getToken()->getUser());

        $event['entity'] = $entity;
    }
}
