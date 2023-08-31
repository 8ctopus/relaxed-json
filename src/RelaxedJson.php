<?php

declare(strict_types=1);

namespace Oct8pus;

use Oct8pus\RelaxedJsonException;
use stdClass;

class RelaxedJson
{
    /**
     * Decode json
     *
     * @param string $json
     * @param ?bool  $associative
     * @param int    $depth
     * @param int    $flags
     *
     * @return mixed
     *
     * @throws RelaxedJsonException
     *
     * @see https://www.php.net/manual/en/function.json-decode.php
     */
    public static function decode(string $json, bool $associative = null, int $depth = 512, int $flags = 0) : mixed
    {
        // strip comments
        $json = preg_replace('~(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)~', '', $json);

        // strip trailing commas
        $json = preg_replace('~,\s*([\]}])~mui', '$1', $json);

        // empty cells
        //$json = preg_replace('~(.+?:)(\s*)?([\]},])~mui', '$1null$3', $json);

        // codes
        //$json = str_replace(["\n", "\r", "\t", "\0"], '', $json);

        $decode = json_decode($json, $associative, $depth, $flags);

        $error = json_last_error();

        if ($error === \JSON_ERROR_NONE) {
            return $decode;
        }

        throw new RelaxedJsonException(json_last_error_msg());
    }
}
