<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Mappers;

use App\Modules\Invoices\Domain\Entities\Company;
use App\Modules\Invoices\Infrastructure\EloquentModels\CompanyEloquentModel;
use Ramsey\Uuid\Uuid;

class CompanyEntityMapper
{
    /**
     * @throws \Exception
     */
    public function fromEloquentModelToEntity(CompanyEloquentModel $model): Company
    {
        return new Company(
            Uuid::fromString($model->id),
            $model->name,
            $model->street,
            $model->city,
            $model->zip,
            $model->phone,
            $model->email,
            $model->created_at,
            $model->updated_at
        );
    }
}
