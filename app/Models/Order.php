<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "pages",
        "deadline",
        "instructions",
        "writer_id",
        "admin_id",
        "spacing",
        "format",
        "cpp",
        "slides",
        "files",
        "sources"
    ];

    public function files(){
        return $this->hasMany(File::class);
    }
}