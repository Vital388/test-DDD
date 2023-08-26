<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Dto;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ProductDto
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $currency,
        public float $price,
        public int $quantity,
        public ?Carbon $createdAt = null,
        public ?Carbon $updatedAt = null,
    ) {
    }
}
