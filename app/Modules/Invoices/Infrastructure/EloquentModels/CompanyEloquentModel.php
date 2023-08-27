<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'street',
        'city',
        'zip',
        'phone',
        'email',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(InvoiceEloquentModel::class);
    }
}
