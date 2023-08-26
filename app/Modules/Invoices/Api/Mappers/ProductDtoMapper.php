<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Mappers;

use App\Modules\Invoices\Api\Dto\ProductDto;
use App\Modules\Invoices\Domain\Entities\Product;

class ProductDtoMapper
{
    /**
     * @param Product[] $products
     * @return ProductDto[]
     */
    public function fromEntitiesToDto(array $products): array
    {
        return array_map([$this, 'fromEntityToDto'], $products);
    }

    public function fromEntityToDto(Product $product): ProductDto
    {
        return new ProductDto(
            $product->getId(),
            $product->getName(),
            $product->getCurrency(),
            $product->getPrice(),
            $product->getQuantity(),
            $product->getCreatedAt(),
            $product->getUpdatedAt()
        );
    }
}
