<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceList extends Model
{
    use HasFactory;

     protected $fillable = [
        'amount',
        'pay_status',
        'writer_id',
        'order_id',
        'invoice_id',
    ];
}