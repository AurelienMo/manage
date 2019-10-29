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

use App\Entity\BankAccount;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class BankAccountSubscriber
 */
class BankAccountSubscriber implements EventSubscriberInterface
{
    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * BankAccountSubscriber constructor.
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
            EasyAdminEvents::PRE_PERSIST => 'onPersist',
        ];
    }

    public function onPersist(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!$entity instanceof BankAccount) {
            return;
        }

        if (is_null($this->tokenStorage->getToken()) ||
            !$this->tokenStorage->getToken()->getUser() instanceof User
        ) {
            return;
        }

        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $user->addBankAccount($entity);
    }
}
