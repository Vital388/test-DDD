<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InvoiceEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'number',
        'date',
        'due_date',
        'company_id',
        'status',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyEloquentModel::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductEloquentModel::class,
            'invoice_product_lines',
            'invoice_id',
            'product_id'
        )->withPivot('quantity');
    }
}
