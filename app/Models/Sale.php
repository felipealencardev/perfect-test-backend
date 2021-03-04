<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function client() {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
