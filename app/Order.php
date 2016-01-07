<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table='order';
    protected $appends = array('statusname');

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

    public function getStatusNameAttribute() {

        switch ($this->status) {

            case 0:
                return 'Pendente';
            case 1:
                return 'Pago';
            case 2:
                return 'Expedido';
            case 3:
                return 'Entregue';
            case 9:
                return 'Cancelado';
            default:
                return 'Indefinido';

        }

    }
}
