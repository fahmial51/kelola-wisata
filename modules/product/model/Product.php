<?php
/**
 * Product
 * @package product
 * @version 0.0.1
 */

namespace Product\Model;

class Product extends \Mim\Model
{

    protected static $table = 'product';

    protected static $chains = [];

    protected static $q = ['name'];
}