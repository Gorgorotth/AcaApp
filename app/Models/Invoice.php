<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

   public const SORT_ASC = 'asc';
   public const SORT_DESC = 'desc';

    /**
     * @var string[]
     */
    protected $fillable = [
        'vin',
        'license_plate',
        'brand',
        'model',
        'garage_id',
        'client_id',
        'mechanic_id',
        'total_price',
        'hourly_price'
    ];

    /**
     * @param $query
     * @param array $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('license_plate', 'like', '%' . $search . '%')
                    ->orWhere('vin', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhere('invoice_number', 'like', '%' . $search . '%');
            });
        });
    }

    /**
     * @return BelongsTo
     */
    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Mechanic::class, 'mechanic_id');
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parts(): HasMany
    {
        return $this->hasMany(InvoicePart::class);
    }

}
