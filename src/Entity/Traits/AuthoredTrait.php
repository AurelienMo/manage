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

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Trait AuthoredTrait
 */
trait AuthoredTrait
{
    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="amo_updated_by_id", referencedColumnName="id", nullable=true)
     */
    protected $updatedBy;

    /**
     * @return UserInterface
     */
    public function getUpdatedBy(): UserInterface
    {
        return $this->updatedBy;
    }

    /**
     * @param UserInterface $updatedBy
     */
    public function setUpdatedBy(UserInterface $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }
}
