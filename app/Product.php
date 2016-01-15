<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $fillable = [

        'category_id',
        'name',
        'description',
        'price',
        'featured',
        'recommended'
    ];

    public function category() {

        return $this->belongsTo('CodeCommerce\Category');

    }

    public function images() {

        return $this->hasMany('CodeCommerce\ProductImages');
    }

    public function tags() {
        return $this->belongsToMany('CodeCommerce\Tag');
    }

    public function scopeFeatured($query) {

        return $query->where('featured','=','1');
    }

    public function scopeRecommended($query) {

        return $query->where('recommended','=','1');
    }

    public function scopeOfCategory($query, $type) {

        return $query->where('category_id','=',$type);
    }

    public function order_items() {
        return $this->HasMany('CodeCommerce\OrderItems');

    }

    public function getTagListAttribute() {

        $tags = $this->tags->lists('name');

        return $tags->implode(',');

    }

}
