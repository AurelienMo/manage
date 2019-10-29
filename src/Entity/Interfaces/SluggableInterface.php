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

/**
 * Interface SluggableInterface
 */
interface SluggableInterface
{
    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @return string
     */
    public function getPropertyForSlug(): string;

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void;
}
