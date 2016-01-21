<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    protected $fillable = [

        'name'
    ];

    public function products() {

        return $this->belongsToMany('CodeCommerce\Product');
    }

    public function scopeofName($query, $name) {

        return $query->whereName($name);
    }

    public function scopeOfProdcut($query, $id) {

       return $this->whereHas('products',
             function ($query) use ($id) { $query->where('product_id',$id); }
       );


    }
}
