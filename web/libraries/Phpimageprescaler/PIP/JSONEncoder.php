<?php
/**
 * Created by PhpStorm.
 * User: klaushartl
 * Date: 01.07.14
 * Time: 15:05
 * Source: http://stackoverflow.com/a/11833393
 */

namespace Phpimageprescaler\PIP;

/**
 * Class JSONEncoder
 * @package phpimageprescaler
 */
class JSONEncoder
{
    /**
     * @param $object
     * @param int $json_encode_options
     * @return string
     */
    public static function json_encode($object, $json_encode_options = 0)
    {
        return json_encode(self::getFields($object), constant($json_encode_options));
    }

    /**
     * @param $classObj
     * @return array
     */
    private static function getFields($classObj)
    {
        $fields = array();
        $reflect = new \ReflectionClass($classObj);
        $props = $reflect->getProperties();
        foreach ($props as $property) {
            $property->setAccessible(true);
            $obj = $property->getValue($classObj);
            $name = $property->getName();
            self::doProperty($fields, $name, $obj);
        }

        return $fields;

    }

    /**
     * @param $fields
     * @param $name
     * @param $obj
     */
    private static function doProperty(&$fields, $name, $obj)
    {

        if (is_object($obj)) {
            $fields[$name] = self::getFields($obj);
            return;
        }

        if (is_Array($obj)) {
            $arrayFields = Array();
            foreach ($obj as $item) {
                $key = key($obj);
                self::doProperty($arrayFields, $key, $item);
                next($obj);
            }
            $fields[$name] = $arrayFields;
        } else
            $fields[$name] = $obj;
    }
} 