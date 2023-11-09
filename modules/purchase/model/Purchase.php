<?php
/**
 * Purchase
 * @package purchase
 * @version 0.0.1
 */

namespace Purchase\Model;

class Purchase extends \Mim\Model
{

    protected static $table = 'purchase';

    protected static $chains = [];

    protected static $q = ['invoice'];
}
