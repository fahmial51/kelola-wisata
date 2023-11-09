<?php
/**
 * Cart
 * @package cart
 * @version 0.1.0
 */

namespace Cart\Library;

use Cart\Model\Cart as _Cart;
use Cart\Model\CartItem as CItem;

class Cart
{
    public static function calculate(object $cart): void
    {
        $cond = ['cart' => $cart->id];
        $price = CItem::sum('total', $cond);
        $set = [
            'items' => CItem::count($cond),
            'quantity' => CItem::sum('quantity', $cond),
            'price' => $price,
            'total' => $price
        ];

        _Cart::set($set, ['id' => $cart->id]);
    }
}
