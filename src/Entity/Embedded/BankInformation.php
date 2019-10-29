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

namespace App\Entity\Embedded;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BankInformation
 *
 * @ORM\Embeddable()
 */
class BankInformation
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected $bankCode;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected $boxCode;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected $numberAccount;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected $ribKey;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected $iban;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected $bic;

    /**
     * @return string|null
     */
    public function getBankCode(): ?string
    {
        return $this->bankCode;
    }

    /**
     * @param string|null $bankCode
     */
    public function setBankCode(?string $bankCode): void
    {
        $this->bankCode = $bankCode;
    }

    /**
     * @return string|null
     */
    public function getBoxCode(): ?string
    {
        return $this->boxCode;
    }

    /**
     * @param string|null $boxCode
     */
    public function setBoxCode(?string $boxCode): void
    {
        $this->boxCode = $boxCode;
    }

    /**
     * @return string|null
     */
    public function getNumberAccount(): ?string
    {
        return $this->numberAccount;
    }

    /**
     * @param string|null $numberAccount
     */
    public function setNumberAccount(?string $numberAccount): void
    {
        $this->numberAccount = $numberAccount;
    }

    /**
     * @return string|null
     */
    public function getRibKey(): ?string
    {
        return $this->ribKey;
    }

    /**
     * @param string|null $ribKey
     */
    public function setRibKey(?string $ribKey): void
    {
        $this->ribKey = $ribKey;
    }

    /**
     * @return string|null
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * @param string|null $iban
     */
    public function setIban(?string $iban): void
    {
        $this->iban = $iban;
    }

    /**
     * @return string|null
     */
    public function getBic(): ?string
    {
        return $this->bic;
    }

    /**
     * @param string|null $bic
     */
    public function setBic(?string $bic): void
    {
        $this->bic = $bic;
    }
}
