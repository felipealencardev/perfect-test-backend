<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'client_id',
        'date',
        'quantity',
        'discount',
        'status'
    ];

    public function setDateAttribute($date) {
        $this->attributes['date'] = Carbon::createFromDate($date)->format('Y-m-d');
    }

    public function getDateAttribute($date) {
        return Carbon::createFromFormat('dd/MM/yyyy', $date);
    }

}
