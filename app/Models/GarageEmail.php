<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarageEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'garage_id',
    ];

    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }
}
