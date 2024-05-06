<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'transaction_type', 'amount', 'fee', 'date'];

    protected $attributes = [
        'fee' => 0, // Default value for 'fee' field
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
