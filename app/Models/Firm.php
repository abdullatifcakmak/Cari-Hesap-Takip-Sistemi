<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Firm extends Model
{
    use HasFactory;

    protected $fillable = ['firm_id', 'name', 'phone', 'email', 'address','debt', 'credit', 'balance','user_id'];


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }





    public function parent()
    {
        return $this->belongsTo(Firm::class, 'firm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }




}

