<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SeatInfo;
use App\Models\Stopage;


class Transport extends Model
{
    use HasFactory;
    protected $table='transports';
    public $timestamps = false;

    public function seatinfos(){
        return $this->hasMany(SeatInfo::class,'transport_id');
    }
    public function fromstopage(){
        return $this->belongsTo(Stopage::class,'from_stopage_id'); 
    }
    public function tostopage(){
        return $this->belongsTo(Stopage::class,'to_stopage_id'); 
    }
}