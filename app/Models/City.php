<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\userinfo;
use App\Models\Stopage;

class City extends Model
{
    use HasFactory;
    protected $table='cities';
    public $timestamps = false;

    public function users(){
        return $this->hasMany(userinfo::class,'city_id');
    }
    public function stopages(){
        return $this->hasMany(Stopage::class,'city_id');
    }
}
