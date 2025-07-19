<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['firm_id', 'type', 'description', 'amount'];

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }




}
