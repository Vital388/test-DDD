<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\Enums\CurrencyEnum;

readonly class Money
{
    public function __construct(
        public float $amount,
        public CurrencyEnum $currency
    ) {
    }
}
