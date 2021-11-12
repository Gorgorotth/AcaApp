<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoicePart extends Model
{
    use HasFactory, SoftDeletes;

    const JOB_TYPE_PART = 1;
    const JOB_TYPE_LIQUID = 2;
    const JOB_TYPE_WORK = 3;

    protected $fillable = [
        'invoice_id',
        'name',
        'stock_no',
        'quantity',
        'price',
        'job_type',
    ];
    public function  getConvertedQuantityAttribute()
    {
        if ($this->job_type == self::JOB_TYPE_LIQUID) {
                $convertedQuantity = $this->quantity . ' liters';
            } elseif ($this->job_type == self::JOB_TYPE_WORK) {
                $convertedQuantity = $this->quantity . ' hours';
            } else {
            $convertedQuantity = $this->quantity;
        }
        return $convertedQuantity;
    }

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function getTypeAttribute()
    {
        $types = trans('garage.job_type');
        return $types[$this->job_type];
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
