<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mime',
        'size',
        'uploaded_by',
        'url'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}