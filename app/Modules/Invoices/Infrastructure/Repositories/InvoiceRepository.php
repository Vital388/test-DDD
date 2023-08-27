<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Repositories;

use App\Modules\Invoices\Domain\Entities\Invoice;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\EloquentModels\InvoiceEloquentModel;
use App\Modules\Invoices\Infrastructure\Mappers\InvoiceEntityMapper;
use Ramsey\Uuid\UuidInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function __construct(
        private InvoiceEloquentModel $model,
        private InvoiceEntityMapper  $invoiceEntityMapper
    ) {
    }

    /**
     * @throws \Exception
     */
    public function getById(UuidInterface $id): Invoice
    {
        $invoiceEloquentModel = $this->model->find($id->toString());
        if (!$invoiceEloquentModel) {
            throw new \Exception('Invoice was not found');
        }

        return $this->invoiceEntityMapper->fromEloquentModelToEntity($invoiceEloquentModel);
    }

    /**
     * TODO
     * @return Invoice[]
     */
    public function getAll(): array
    {
        return [];
    }

    public function create(array $attributes): Invoice
    {
        $eloquentModel = $this->model->create($attributes);

        return $this->invoiceEntityMapper->fromEloquentModelToEntity($eloquentModel);
    }

    /**
     * @throws \Exception
     */
    public function update(Invoice $invoice): bool
    {
        $eloquentModel = $this->model->find($invoice->getId()->toString());

        if (!$invoice) {
            throw new \Exception('Invoice was not found');
        }

        $eloquentModel = $this->invoiceEntityMapper->fromEntityToEloquentModel($invoice, $eloquentModel);

        return $eloquentModel->save();
    }

    public function delete(Invoice $invoice): bool
    {
        return $this->model->destroy($invoice->getId()->toString()) > 0;
    }
}
