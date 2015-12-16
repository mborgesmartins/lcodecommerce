<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table='order';

    protected $fillable = [
        'user_id',
        'total',
        'status'
        ];

    public function user() {
        return $this->belongsTo('CodeCommerce\User');
    }
    public function items() {
        return $this->hasMany('CodeCommerce\OrderItems');

    }
}
