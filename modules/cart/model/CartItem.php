<?php
/**
 * CartItem
 * @package cart
 * @version 0.0.1
 */

namespace Cart\Model;

class CartItem extends \Mim\Model
{

    protected static $table = 'cart_item';

    protected static $chains = [];

    protected static $q = [];
}