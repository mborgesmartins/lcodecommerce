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
        'status',
        'payment_code'
        ];

    private $status_types = [

        0 => 'Pendente',
        1 => 'Pago',
        2 => 'Expedido',
        3 => 'Entregue',
        4 => 'Disponível',
        9 => 'Cancelado'
    ];

    public function user() {
        return $this->belongsTo('CodeCommerce\User');
    }
    public function items() {
        return $this->hasMany('CodeCommerce\OrderItems');

    }

    public function getStatusNameAttribute()
    {

        $valid_ids = [];
        foreach ($this->status_types as $id => $nome) $valid_ids[] = $id;

        if (in_array($this->status, $valid_ids)) {
            return $this->status_types[$this->status];
        } else
            return 'Indefinido';

        /*
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
        */
    }

    public function getStatusTypes() {

        return $this->status_types;
    }
}
