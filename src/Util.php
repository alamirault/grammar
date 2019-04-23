<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 15:53
 */

namespace Alamirault\Grammar;


class Util
{
    public static function flattenArray(array $array)
    {
        $result = [];

        foreach ($array as $item) {
            if (is_array($item)) {
                $result = array_merge($result, static::flattenArray($item));

                continue;
            }

            $result[] = $item;
        }

        return $result;
    }

    public static function nonNull(array $array)
    {
        return array_filter($array, function ($v) { return $v !== null; });
    }
}