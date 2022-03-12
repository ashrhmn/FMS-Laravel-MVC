<?php

namespace App\Models;

use App\Http\Controllers\PageController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchasedTicket;
use App\Models\City;
use App\Models\Family;

class User extends Model
{
    use HasFactory;

    protected $table = "users";
    public $timestamps = false;

    public function purchasedtickets()
    {
        return $this->hasMany(PurchasedTicket::class, 'purchased_by');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id');
    }
}
