<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Dto;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class CompanyDto
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $street,
        public string $city,
        public string $zip,
        public string $phone,
        public string $email,
        public ?Carbon $createdAt = null,
        public ?Carbon $updatedAt = null,
    ) {
    }
}
