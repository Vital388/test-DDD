<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'price',
        'currency',
        'created_at',
        'updated_at',
    ];

    public function invoice(): BelongsToMany
    {
        return $this->belongsToMany(
            InvoiceEloquentModel::class,
            'invoice_product_lines',
            'product_id',
            'invoice_id'
        );
    }
}
