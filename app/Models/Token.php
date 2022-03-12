<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table = "tokens";
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
