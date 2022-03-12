<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\PurchasedTicket;
use App\Models\Transport;

class Stopage extends Model
{
    use HasFactory;
    protected $table='stopages';
    public $timestamps = false;

    public function city(){
        return $this->belongsTo(City::class,'city_id');  
    }
    public function purchasedtickets(){
        return $this->hasMany(PurchasedTicket::class,'from_stopage_id','to_stopage_id');
    }
    public function transports(){
        return $this->hasMany(Transport::class,'from_stopage_id','to_stopage_id');
    }
    
}