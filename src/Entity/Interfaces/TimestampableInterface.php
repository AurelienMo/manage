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

use DateTime;

/**
 * Interface TimestampableInterface
 */
interface TimestampableInterface
{
    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime;

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime;

    /**
     * @param DateTime|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?DateTime $updatedAt): void;
}
