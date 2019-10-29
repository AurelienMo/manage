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

namespace App\Entity\Interfaces;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface AuthoredInterface
 */
interface AuthoredInterface
{
    /**
     * @return UserInterface
     */
    public function getUpdatedBy(): UserInterface;

    /**
     * @param UserInterface $user
     */
    public function setUpdatedBy(UserInterface $user): void;
}
