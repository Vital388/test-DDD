<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Mappers;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Domain\Entities\Invoice;
use App\Modules\Invoices\Infrastructure\EloquentModels\InvoiceEloquentModel;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class InvoiceEntityMapper
{
    public function __construct(
        private CompanyEntityMapper $companyEntityMapper,
        private ProductEntityMapper $productEntityMapper
    ) {
    }

    /**
     * @throws \Exception
     */
    public function fromEloquentModelToEntity(InvoiceEloquentModel $model): Invoice
    {
        $company = $this->companyEntityMapper->fromEloquentModelToEntity($model->company);
        $products = $this->productEntityMapper->fromEloquentModelsToEntity($model->products);

        return new Invoice(
            Uuid::fromString($model->id),
            Uuid::fromString($model->number),
            Carbon::parse($model->date),
            Carbon::parse($model->due_date),
            StatusEnum::tryFrom($model->status),
            $company,
            $products,
            $model->created_at,
            $model->updated_at
        );
    }

    public function fromEntityToEloquentModel(Invoice $invoice, InvoiceEloquentModel $model): InvoiceEloquentModel
    {
        $model->number = $invoice->getNumber()->toString();
        $model->date = $invoice->getDate();
        $model->due_date = $invoice->getDueDate();
        $model->status = $invoice->getStatus()->value;

        return $model;
    }
}
