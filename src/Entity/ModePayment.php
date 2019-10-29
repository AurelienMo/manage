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

use App\Entity\Interfaces\AuthoredInterface;
use App\Entity\Interfaces\TimestampableInterface;
use App\Entity\Traits\AuthoredTrait;
use App\Entity\Traits\NameTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ModePayment
 *
 * @ORM\Table(name="amo_mode_payment")
 * @ORM\Entity(repositoryClass="App\Repository\ModePaymentRepository")
 */
class ModePayment extends AbstractEntity implements TimestampableInterface, AuthoredInterface
{
    use NameTrait;
    use TimestampableTrait;
    use AuthoredTrait;
}
