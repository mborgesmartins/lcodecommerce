<?php

namespace CodeCommerce;
/**
 * Created by PhpStorm.
 * User: borges
 * Date: 14/12/15
 * Time: 16:06
 */
class Cart
{

    private $items;

    public function __construct()
    {
        $this->items = [];

    }

    public function add($id, $name, $price, $image)
    {

        $product = Product::find($id);

        $this->items += [

                $id =>
                    [
                        'name' => $name,
                        'price' => $price,
                        'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ : 1,
                        'image' => $image
                    ]

            ];

        return $this->items;

    }

    public function remove($id)
    {

        unset($this->items[$id]);

    }

    public function all()
    {

        return $this->items;

    }

    public function getTotal()
    {

        $total = 0;

        foreach($this->items as $item) {
            $total += $item['qtd'] * $item['price'];
        }

        return $total;

    }

    public function update_qty($id_p, $qty) {

        $this->items[$id_p]['qtd'] = $qty;
        return $this->items;

    }

    public function clear() {

        $this->items = [];

    }


}