<?php
/**
 * Custom validator for lib-validator
 * @package lib-model
 * @version 0.0.1
 */

namespace LibModel\Validator;

class Model
{
    protected static function getServiceValue(string $keys)
    {
        $keys = explode('.', $keys);
        $result = \Mim::$app;

        foreach ($keys as $key) {
            if ($result) {
                $result = $result->$key ?? null;
            } else {
                break;
            }
        }

        return $result;
    }

    protected static function getBodyValue(string $keys)
    {
        $keys = explode('.', $keys);
        $result = \Mim::$app->req->getBody();

        foreach ($keys as $key) {
            if ($result) {
                $result = $result->$key ?? null;
            } else {
                break;
            }
        }

        return $result;
    }

    protected static function buildWhere(&$where): void
    {
        foreach ($where as $key => $value) {
            if (is_string($value)) {
                $where->$key = self::buildWhereString($value);
            } elseif (is_array($value)) {
                foreach ($value as $vkey => $vval) {
                    if (is_string($vval)) {
                        $value[$vkey] = self::buildWhereString($vval);
                    }
                }
                $where->$key = $value;
            }
        }
    }

    protected static function buildWhereString($value)
    {
        if (!$value) {
            return $value;
        }
        $key = substr($value, 0, 2);

        if (!in_array($key, ['_$', '_#'])) {
            return $value;
        }

        if ($key == '_$') {
            return self::getServiceValue(substr($value, 3));
        } elseif ($key == '_#') {
            return self::getBodyValue(substr($value, 3));
        }
    }

    static function unique($value, $options, $object, $field, $rules): ?array
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        $model  = $options->model;
        $mfield = $options->field;
        $mself  = $options->self ?? null;
        $mwhere = $options->where ?? null;

        $cond = [$mfield => $value];
        if ($mwhere) {
            self::buildWhere($mwhere);
            $cond = array_replace((array)$mwhere, $cond);
        }

        $row = $model::getOne($cond);
        if (!$row) {
            return null;
        }

        if (!$mself) {
            return ['14.0'];
        }

        $obj = \Mim::$app;
        $mself_serv = explode('.', $mself->service);
        foreach($mself_serv as $prop){
            $obj = $obj->$prop ?? null;
            if (is_null($obj)) {
                break;
            }
        }

        $row_val = $row->{$mself->field};

        if ($row_val == $obj) {
            return null;
        }
        return ['14.0'];
    }

    static function exists($value, $options, $object, $field, $rules): ?array
    {
        if (is_null($value)) {
            return null;
        }
        if (!$value) {
            return null;
        }

        $model  = $options->model;
        $mfield = $options->field;
        $mwhere = $options->where ?? null;

        $cond = [$mfield => $value];
        if ($mwhere) {
            self::buildWhere($mwhere);
            $cond = array_replace((array)$mwhere, $cond);
        }

        $row = $model::getOne($cond);
        if ($row) {
            return null;
        }

        return ['19.0'];
    }

    static function existsList($value, $options, $object, $field, $rules): ?array
    {
        if (is_null($value)) {
            return null;
        }
        if (!$value) {
            return null;
        }

        $value = (array)$value;

        $model  = $options->model;
        $mfield = $options->field;
        $mwhere = $options->where ?? null;

        $cond = [$mfield => $value];
        if ($mwhere) {
            self::buildWhere($mwhere);
            $cond = array_replace((array)$mwhere, $cond);
        }

        $rows = $model::get($cond);
        if (!$rows) {
            return ['20.0'];
        }

        $values = array_column($rows, $mfield);
        foreach ($value as $val) {
            if (!in_array($val, $values)) {
                return ['20.0'];
            }
        }

        return null;
    }
}
