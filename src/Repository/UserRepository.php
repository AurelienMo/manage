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

namespace App\Repository;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractRepository implements UserLoaderInterface
{
    public function getEntityClassName()
    {
        return User::class;
    }

    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
                    ->where('u.email = :email')
                    ->setParameter('email', $username)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
