<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Services;

use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Application\ApprovalFacade;
use App\Modules\Invoices\Domain\Entities\Invoice;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class InvoiceService
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository,
        private ApprovalFacade $approvalFacade
    ) {
    }

    /**
     * @throws \Exception
     */
    public function getById(UuidInterface $id): Invoice
    {
        return $this->invoiceRepository->getById($id);
    }

    /**
     * @throws \Exception
     */
    public function approve(UuidInterface $id): void
    {
        $invoice = $this->getById($id);
        $approvalDto = new ApprovalDto($id, $invoice->getStatus(), Invoice::class);
        $this->approvalFacade->approve($approvalDto);
        $invoice->approve();
        $this->invoiceRepository->update($invoice);
    }

    /**
     * @throws \Exception
     */
    public function reject(UuidInterface $id): void
    {
        $invoice = $this->getById($id);
        $approvalDto = new ApprovalDto($id, $invoice->getStatus(), Invoice::class);
        $this->approvalFacade->approve($approvalDto);
        $invoice->reject();
        $this->invoiceRepository->update($invoice);
    }
}
