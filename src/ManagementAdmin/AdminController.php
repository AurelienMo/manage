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

namespace App\ManagementAdmin;

use App\Entity\BankAccount;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

/**
 * Class AdminController
 */
class AdminController extends EasyAdminController
{
    protected function createBankAccountListQueryBuilder(
        $entityClass,
        $sortDirection,
        $sortField = null,
        $dqlFilter = null
    ) {
        return parent::createListQueryBuilder(
            $entityClass,
            $sortDirection,
            $sortField,
            sprintf("entity.owner = '%s'", $this->getUser()->getId())
        );
    }
}
