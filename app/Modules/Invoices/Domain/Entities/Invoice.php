<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entities;

use App\Domain\Enums\CurrencyEnum;
use App\Domain\Enums\StatusEnum;
use App\Domain\ValueObjects\Money;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class Invoice
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $number,
        private Carbon $date,
        private Carbon $dueDate,
        private StatusEnum $status,
        private Company $company,
        /**
         * @var Product[]
         */
        private array $products,
        private ?Carbon $createdAt = null,
        private ?Carbon $updatedAt = null,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function getNumber(): UuidInterface
    {
        return $this->number;
    }

    public function setNumber(UuidInterface $number): void
    {
        $this->number = $number;
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }

    public function setDate(Carbon $date): void
    {
        $this->date = $date;
    }

    public function getDueDate(): Carbon
    {
        return $this->dueDate;
    }

    public function setDueDate(Carbon $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): void
    {
        $this->status = $status;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function approve(): void
    {
        $this->setStatus(StatusEnum::APPROVED);
    }

    public function reject(): void
    {
        $this->setStatus(StatusEnum::REJECTED);
    }

    public function getTotalPrice(): Money
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getTotalPrice()->amount;
        }

        return new Money(
            $total,
            CurrencyEnum::USD
        );
    }
}
