<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Api\Mappers\InvoiceDtoMapper;
use App\Modules\Invoices\Application\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class InvoiceController extends Controller
{
    public function __construct(
        private InvoiceService $invoiceService,
        private InvoiceDtoMapper $invoiceDtoMapper
    ) {
    }

    public function get(string $id): JsonResponse
    {
        $invoice = $this->invoiceService->getById(Uuid::fromString($id));
        $invoiceDto = $this->invoiceDtoMapper->fromEntityToDto($invoice);

        return response()->json($invoiceDto);
    }

    public function approve(string $id): JsonResponse
    {
        try {
            $this->invoiceService->approve(Uuid::fromString($id));
        } catch (\Exception $exception) {
            return response()->json("Invoice hasn't been approved", 400);
        }

        return response()->json('Invoice has been approved');
    }

    public function reject(string $id): JsonResponse
    {
        try {
            $this->invoiceService->reject(Uuid::fromString($id));
        } catch (\Exception $exception) {
            return response()->json("Invoice hasn't been rejected", 400);
        }

        return response()->json('Invoice has been rejected');
    }
}
