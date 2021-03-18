<?php

namespace App\Services;

use JsonException;

class Json
{
    public static function encode($data)
    {
        return json_encode($data);
    }

    public static function decode($json, $assoc = false)
    {
        $res = json_decode($json, $assoc);

        if ($res == 0) {
            throw new JsonException("INVALID_JSON", 1);
        }

        return $res;
    }
}
