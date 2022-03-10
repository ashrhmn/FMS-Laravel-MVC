<?php

namespace App\Models;

use App\Http\Controllers\PageController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userinfo extends Model
{
    use HasFactory;

    protected $table="users";
    public $timestamps=false;
}
