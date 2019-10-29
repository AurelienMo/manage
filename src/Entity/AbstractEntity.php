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

namespace App\Entity;

use App\Entity\Interfaces\TimestampableInterface;
use App\Entity\Traits\TimestampableTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity implements TimestampableInterface
{
    use TimestampableTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    protected $id;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->id = Uuid::uuid4()->toString();
    }
}
