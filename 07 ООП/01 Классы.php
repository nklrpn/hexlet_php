<?php

/**
 * Реализуйте класс корзины Cart, 
 * объявив в нем публичное поле items, 
 * в котором должен храниться список товаров. 
 * Инициализируйте поле пустым массивом.
 * 
 * Реализуйте следующие функции:
 *   addToCart, которая добавляет в корзину товар, переданный в качестве второго аргумента
 *   getCount, которая возвращает количество товаров, помещенных в корзину
 *   getTotal, которая возвращает суммарную стоимость товаров, помещенных в корзину
 * 
 * Пример:
 *   use Shop\Cart;
 *   use function Solution\addToCart;
 *   use function Solution\getCount;
 *   use function Solution\getTotal;
 * 
 *   $cart = new Cart();
 * 
 *   addToCart($cart, new Item("milk", 5))
 *   addToCart($cart, new Item("water", 2));
 * 
 *   getCount($cart); // 2
 *   getTotal($cart); // 7
 * 
 *   addToCart($cart, new Item("juice", 10));
 * 
 *   getCount($cart); // 3
 *   getTotal($cart); // 17
 */ 
 
class Item
{
    public $name;
    public $price;
    
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
}

class Cart
{
    public $items = [];
    
    public function addToCart(Cart $cart, Item $item)
    {
        // BEGIN (write your solution here)
        $this->items[] = $item;
        // END
    }
    
    public function getCount(Cart $cart)
    {
        // BEGIN (write your solution here)
        return count($this->items);
        // END
    }
    
    public function getTotal(Cart $cart)
    {
        // BEGIN (write your solution here)
        return array_sum(array_map(function ($item) {
          return $item->price;
        }, $this->items)); 
        // END
    }
}

// Solution.php

function addToCart(Cart $cart, Item $item)
{
    // BEGIN (write your solution here)
    $cart->addToCart($item);
    // END
}

public function getCount(Cart $cart)
{
    // BEGIN (write your solution here)
    return $cart->getCount();
    // END
}

public function getTotal(Cart $cart)
{
    // BEGIN (write your solution here)
    return $cart->getTotal();
    // END
}

// ============== 

$i = new Item('milk', 10);

$cart = new Cart();

addToCart($cart, $i);

echo 'Count: ', getCount($cart), PHP_EOL;
echo 'Total: ', getTotal($cart), PHP_EOL;

$j = new Item('bread', 5);

addToCart($cart, $j);

echo 'Count: ', getCount($cart), PHP_EOL;
echo 'Total: ', getTotal($cart), PHP_EOL;

// Count: 1
// Total: 10
// Count: 2
// Total: 15