<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Mappers;

use App\Modules\Invoices\Api\Dto\InvoiceDto;
use App\Modules\Invoices\Domain\Entities\Invoice;

class InvoiceDtoMapper
{
    public function __construct(
        private CompanyDtoMapper $companyDtoMapper,
        private ProductDtoMapper $productDtoMapper
    ) {
    }

    public function fromEntityToDto(Invoice $invoice): InvoiceDto
    {
        $company = $this->companyDtoMapper->fromEntityToDto($invoice->getCompany());
        $products = $this->productDtoMapper->fromEntitiesToDto($invoice->getProducts());

        return new InvoiceDto(
            $invoice->getId(),
            $invoice->getNumber(),
            $invoice->getDate(),
            $invoice->getDueDate(),
            $invoice->getStatus(),
            $company,
            $products,
            $invoice->getTotalPrice(),
            $invoice->getCreatedAt(),
            $invoice->getUpdatedAt()
        );
    }
}
