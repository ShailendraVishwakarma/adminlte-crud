<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    //
     use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'total_products',
        'status'
    ];
}
