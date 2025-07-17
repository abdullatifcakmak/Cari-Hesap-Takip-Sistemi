<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = ['stock_id', 'firm_id', 'movement_type', 'quantity', 'unit_price'];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
}
