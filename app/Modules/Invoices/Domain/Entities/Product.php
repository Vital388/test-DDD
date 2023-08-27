<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entities;

use App\Domain\Enums\CurrencyEnum;
use App\Domain\ValueObjects\Money;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class Product
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private CurrencyEnum $currency,
        private Money $price,
        private int $quantity,
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function setCurrency(CurrencyEnum $currency): void
    {
        $this->currency = $currency;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getTotalPrice(): Money
    {
        return new Money(
            $this->price->amount * $this->quantity,
            CurrencyEnum::USD
        );
    }
}
