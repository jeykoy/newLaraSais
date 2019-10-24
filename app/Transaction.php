<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Orderlist;

class Transaction extends Model
{
    //
    protected $guarded=[];

    public function orderlists(){
        return $this->belongsTo(Orderlist::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

}
