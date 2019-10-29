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

use App\Entity\BankAccount;

/**
 * Class BankAccountRepository
 */
class BankAccountRepository extends AbstractRepository
{
    public function getEntityClassName()
    {
        return BankAccount::class;
    }
}
