<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Repositories;

use App\Modules\Invoices\Domain\Entities\Invoice;
use Ramsey\Uuid\UuidInterface;

interface InvoiceRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function getById(UuidInterface $id): Invoice;

    /**
     * @return Invoice[]
     */
    public function getAll(): array;

    public function create(array $attributes): Invoice;

    /**
     * @throws \Exception
     */
    public function update(Invoice $invoice): bool;

    public function delete(Invoice $invoice): bool;
}
