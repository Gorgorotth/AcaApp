<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GarageEmail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'garage_id',
    ];

    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }
}
