<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;
class Orderlist extends Model
{
    protected $guarded = [];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
    