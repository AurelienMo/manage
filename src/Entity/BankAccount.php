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

use App\Entity\Embedded\BankInformation;
use App\Entity\Interfaces\AuthoredInterface;
use App\Entity\Interfaces\SluggableInterface;
use App\Entity\Interfaces\TimestampableInterface;
use App\Entity\Traits\AuthoredTrait;
use App\Entity\Traits\NameTrait;
use App\Entity\Traits\SlugTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BankAccount
 *
 * @ORM\Table(name="amo_bank_account")
 * @ORM\Entity(repositoryClass="App\Repository\BankAccountRepository")
 */
class BankAccount extends AbstractEntity implements SluggableInterface, TimestampableInterface, AuthoredInterface
{
    use SlugTrait;
    use TimestampableTrait;
    use AuthoredTrait;
    use NameTrait;

    /**
     * @var Bank|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Bank")
     * @ORM\JoinColumn(name="amo_bank_id", referencedColumnName="id")
     */
    protected $bank;

    /**
     * @var BankInformation
     *
     * @ORM\Embedded(class="App\Entity\Embedded\BankInformation")
     */
    protected $bankInformation;

    /**
     * @var float|null
     *
     * @ORM\Column(type="float")
     */
    protected $balance;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bankAccounts")
     * @ORM\JoinColumn(name="amo_owner_id", referencedColumnName="id")
     */
    protected $owner;

    public function __construct()
    {
        $this->bankInformation = new BankInformation();
        parent::__construct();
    }

    /**
     * @return Bank|null
     */
    public function getBank(): ?Bank
    {
        return $this->bank;
    }

    /**
     * @param Bank|null $bank
     */
    public function setBank(?Bank $bank): void
    {
        $this->bank = $bank;
    }

    /**
     * @return BankInformation
     */
    public function getBankInformation(): BankInformation
    {
        return $this->bankInformation;
    }

    /**
     * @param BankInformation $bankInformation
     */
    public function setBankInformation(BankInformation $bankInformation): void
    {
        $this->bankInformation = $bankInformation;
    }

    /**
     * @return float|null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @param float|null $balance
     */
    public function setBalance(?float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

    public function getPropertyForSlug(): string
    {
        return 'name';
    }
}
