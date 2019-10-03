<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderlist extends Model
{
    protected $guarded = [];

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
    