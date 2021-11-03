<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'vin',
        'license_plate',
        'brand',
        'model',
        'garage_id',
        'mechanic_id',
        'total_price',
        'hourly_price'
    ];

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

    public function parts()
    {
        return $this->hasMany(InvoicePart::class);
    }

}
