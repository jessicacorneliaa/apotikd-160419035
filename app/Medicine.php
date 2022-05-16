<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function transaction(){
        return $this->belongsToMany('App\Transaction', 'medicine_transaction', 'medicine_id', 'transaction_id')
                    ->withPivot('quantity', 'price');
    }
}
