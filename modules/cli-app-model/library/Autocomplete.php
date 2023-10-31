<?php
/**
 * Autocomplete
 * @package cli-app-model
 * @version 0.0.1
 */

namespace CliAppModel\Library;

class Autocomplete extends \Cli\Autocomplete
{

    static function command(array $args) {
        $farg = $args[2] ?? null;

        $result = ['test', 'schema', 'start'];

        if(!$farg)
            return trim(implode(' ', $result));

        return parent::lastArg($farg, $result);
    }
}