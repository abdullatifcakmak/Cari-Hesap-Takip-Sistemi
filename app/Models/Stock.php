<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'supplier_name',
        'stock',
        'purchase_price',
        'sale_price',
        'user_id',
        'deleted_at'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
