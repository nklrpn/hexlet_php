<?php

// Реализуйте в классе Shop\Cart следующие методы:

// add - для добавления товаров в корзину
// count - для получения количества товаров в корзине
// total - для получения общей суммы товаров в корзине
// remove - для удаления товара из корзины по id
// clear - для очистки корзины
// Пример:

// use Shop\Cart;

// $cart = new Cart();

// $cart->add(new Item(1, "milk", 5))
// $cart->add(new Item(2, "water", 2));

// $cart->count(); // 2
// $cart->total(); // 7

// $cart->remove(2);

// $cart->count(); // 1
// $cart->total(); // 5

// $cart->clear();

// $cart->count(); // 0
// $cart->total(); // 0

class Item
{
    public $id;
    public $name;
    public $price;

    public function __construct($id, $name, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
}

class Cart
{
    private $items = [];
    
    // BEGIN (write your solution here)
    public function add(Item $item)
    {
        $this->items[] = $item;
    }
    
    public function count()
    {
        return count($this->items);
    }
    
    public function total()
    {
        return array_reduce($this->items, function ($sum, $item) {
            return $sum + $item->price;
        }, 0);
    }
    
    public function remove($id)
    {
        $itemNum = array_map(function ($key, $item) use ($id) {
                return ($item->id === $id) ? $key : null;
            }, array_keys($this->items), array_values($this->items)
        );
        
        $itemNum = array_filter($itemNum, function ($i) {
            return !is_null($i);
        });
        
        if (!is_null($itemNum)) {
            $itemNumVal = array_pop($itemNum);
            unset($this->items[$itemNumVal]);
        }
        
        /* TEACHER'S */
        $this->items = array_values(array_filter($this->items, function (Item $item) use ($id) {
            return $id !== $item->id;
        }));
        /* END */
    }
    
    public function clear()
    {
        $this->items = [];
    }
    // END
}
