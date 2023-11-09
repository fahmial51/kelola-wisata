<?php
/**
 * Invoice
 * @package purchase
 * @version 0.1.0
 */

namespace Purchase\Library;


class Invoice
{
    public static function generate(object $purchase): string
    {
        $id = $purchase->id;
        $prefix = \Mim::$app->config->purchase->invoice->prefix ?? 'INV-';
        $length = \Mim::$app->config->purchase->invoice->length ?? 8;

        return $prefix . str_pad($id, $length, '0', STR_PAD_LEFT);
    }
}
