<?php

namespace App\Modules\Invoices\Infrastructure\Mappers;

use App\Modules\Invoices\Domain\Entities\Product;
use App\Modules\Invoices\Infrastructure\EloquentModels\ProductEloquentModel;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class ProductEntityMapper
{
    /**
     * @param Collection $products
     * @return Product[]
     */
    public function fromEloquentModelsToEntity(Collection $products): array
    {
        return $products->map([$this, 'fromEloquentModelToEntity'])->all();
    }

    public function fromEloquentModelToEntity(ProductEloquentModel $model): Product
    {
        return new Product(
            Uuid::fromString($model->id),
            $model->name,
            $model->currency,
            $model->price,
            $model->pivot->quantity,
            $model->created_at,
            $model->updated_at
        );
    }
}
