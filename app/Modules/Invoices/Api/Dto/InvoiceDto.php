<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Dto;

use App\Domain\Enums\StatusEnum;
use Carbon\Carbon;
use DateTimeInterface;
use Ramsey\Uuid\UuidInterface;

class InvoiceDto
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $number,
        public DateTimeInterface $date,
        public DateTimeInterface $dueDate,
        public StatusEnum $status,
        public CompanyDto $company,
        /**
         * @var ProductDto[]
         */
        public array $products,
        public ?Carbon $createdAt = null,
        public ?Carbon $updatedAt = null,
    ) {
    }
}
