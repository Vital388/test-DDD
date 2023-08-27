<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Dto;

use App\Domain\Enums\CurrencyEnum;
use App\Domain\ValueObjects\Money;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ProductDto
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public CurrencyEnum $currency,
        public Money $price,
        public int $quantity,
        public Money $totalPrice,
        public ?Carbon $createdAt = null,
        public ?Carbon $updatedAt = null,
    ) {
    }
}
