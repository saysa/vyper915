<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 11/09/2014
 * Time: 13:28
 */

namespace Vyper\SiteBundle\Components\Strings;

class StringMethods {

    private static $_delimiter = "#";
    private function __construct()
    {
        // do nothing
    }

    private static function _normalize($pattern)
    {
        return self::$_delimiter.trim($pattern, self::$_delimiter).self::$_delimiter;
    }

    public static function getDelimiter()
    {
        return self::$_delimiter;
    }

    public static function setDelimiter($delimiter)
    {
        self::$_delimiter =  $delimiter;
    }

    /**
     * Return an array match from a pattern
     * @param string $string
     * @param string $pattern
     * @return array|NULL
     */
    public static function match($string, $pattern)
    {
        preg_match_all(self::_normalize($pattern), $string, $matches, PREG_PATTERN_ORDER);

        if (!empty($matches[1]))
        {
            return $matches[1];
        }

        if (!empty($matches[0]))
        {
            return $matches[0];
        }

        return null;
    }

    public static function split($string, $pattern, $limit = null)
    {
        $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE;
        return preg_split(self::_normalize($pattern), $string, $limit, $flags);
    }

    private static $_singular = array(
        "(matr)ices$" => "\\1ix",
        "(vert|ind)ices$" => "\\1ex",
        "^(ox)en" => "\\1",
        "(alias)es$" => "\\1",
        "([octop|vir])i$" => "\\1us",
        "(cris|ax|test)es$" => "\\1is",
        "(shoe)s$" => "\\1",
        "(o)es$" => "\\1",
        "(bus|campus)es$" => "\\1",
        "([m|l])ice$" => "\\1ouse",
        "(x|ch|ss|sh)es$" => "\\1",
        "(m)ovies$" => "\\1\\2ovie",
        "(s)eries$" => "\\1\\2eries",
        "([^aeiouy]|qu)ies$" => "\\1y",
        "([lr])ves$" => "\\1f",
        "(tive)s$" => "\\1",
        "(hive)s$" => "\\1",
        "([^f])ves$" => "\\1fe",
        "(^analy)ses$" => "\\1sis",
        "((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$" => "\\1\\2sis",
        "([ti])a$" => "\\1um",
        "(p)eople$" => "\\1\\2erson",
        "(m)en$" => "\\1an",
        "(s)tatuses$" => "\\1\\2tatus",
        "(c)hildren$" => "\\1\\2hild",
        "(n)ews$" => "\\1\\2ews",
        "([^u])s$" => "\\1"
    );

    private static $_plural = array(
        "^(ox)$" => "\\1\\2en",
        "([m|l])ouse$" => "\\1ice",
        "(matr|vert|ind)ix|ex$" => "\\1ices",
        "(x|ch|ss|sh)$" => "\\1es",
        "([^aeiouy]|qu)y$" => "\\1ies",
        "(hive)$" => "\\1s",
        "(?:([^f])fe|([lr])f)$" => "\\1\\2ves",
        "sis$" => "ses",
        "([ti])um$" => "\\1a",
        "(p)erson$" => "\\1eople",
        "(m)an$" => "\\1en",
        "(c)hild$" => "\\1hildren",
        "(buffal|tomat)o$" => "\\1\\2oes",
        "(bu|campu)s$" => "\\1\\2ses",
        "(alias|status|virus)" => "\\1es",
        "(octop)us$" => "\\1i",
        "(ax|cris|test)is$" => "\\1es",
        "s$" => "s",
        "$" => "s"
    );

    public static function singular($string)
    {
        $result = $string;
        foreach (self::$_singular as $rule => $replacement)
        {
            $rule = self::_normalize($rule);
            if (preg_match($rule, $string))
            {
                $result = preg_replace($rule, $replacement, $string);
                break;
            }
        }
        return $result;
    }

    function plural($string)
    {
        $result = $string;
        foreach (self::$_plural as $rule => $replacement)
        {
            $rule = self::_normalize($rule);
            if (preg_match($rule, $string))
            {
                $result = preg_replace($rule, $replacement, $string);
                break;
            }
        }
        return $result;
    }

    public static function sanitize($string, $mask)
    {
        if (is_array($mask))
        {
            $parts = $mask;
        }
        else if (is_string($mask))
        {
            $parts = str_split($mask);
        }
        else
        {
            return $string;
        }

        foreach ($parts as $part)
        {
            $normalized = self::_normalize("\\{$part}");
            $string = preg_replace(
                "{$normalized}m",
                "\\{$part}",
                $string
            );
        }

        return $string;
    }

    public static function unique($string)
    {
        $unique = "";
        $parts = str_split($string);

        foreach ($parts as $part)
        {
            if (!strstr($unique, $part))
            {
                $unique .= $part;
            }
        }
        return $unique;
    }

    public static function indexOf($string, $substring, $offset = null)
    {
        $position = strpos($string, $substring, $offset);
        if (!is_int($position))
        {
            return -1;
        }
        return $position;
    }

    public static function sqlDateToCustom($sqlDate, $custom = "%d %B %Y")
    {
        setlocale (LC_TIME, 'fr_FR.utf8','fra');
        $month = substr($sqlDate, 5, 2);
        $year = substr($sqlDate, 0, 4);
        $day = substr($sqlDate, 8, 2);
        $time = mktime(0,0,0,$month,$day,$year);
        return ucfirst(strftime( $custom, $time ));
    }

    public static function filterURL($string)
    {
        $emptyItem = array(

            "(",
            ")",
            "[",
            "]",
            ";",
            ",",
            ".",
            "?",
            "’",
            ":",
            ">",
            "<",
            "!",
            "=",
            "°",
            "♪♯",
            "♂",
            "†",
            "→",
            "~",
            "&",
            "☆",
            "|",
            "‘",
            "Ø",
            "+"

        );

        $titre_url=stripslashes($string);

        $titre_url=str_replace  ( "'"  , "-" , $titre_url  );
        $titre_url=str_replace  ( " "  , "-" , $titre_url  );
        $titre_url=str_replace  ( "\?"  , "" , $titre_url  );
        $titre_url=str_replace  ( "~"  , "-" , $titre_url  );

        $titre_url=str_replace  ( "&quot;"  , "" , $titre_url  ); //-- "
        $titre_url=str_replace  ( "\""  , "" , $titre_url  ); //-- "
        $titre_url=str_replace  ( "/"  , "-" , $titre_url  );

        $titre_url=str_replace  ( "ç"  , "c" , $titre_url  );
        $titre_url=str_replace  ( "&"  , "et" , $titre_url  );

        $titre_url=str_replace  ( "à"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "á"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "â"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "ä"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "À"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "Á"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "Â"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "Ä"  , "a" , $titre_url  );

        $titre_url=str_replace  ( "è"  , "e" , $titre_url  );
        $titre_url=str_replace  ( "é"  , "e" , $titre_url  );
        $titre_url=str_replace  ( "ê"  , "e" , $titre_url  );
        $titre_url=str_replace  ( "ë"  , "e" , $titre_url  );
        $titre_url=str_replace  ( "È"  , "e" , $titre_url  );
        $titre_url=str_replace  ( "É"  , "e" , $titre_url  );
        $titre_url=str_replace  ( "Ê"  , "e" , $titre_url  );
        $titre_url=str_replace  ( "Ë"  , "e" , $titre_url  );

        $titre_url=str_replace  ( "ì"  , "i" , $titre_url  );
        $titre_url=str_replace  ( "î"  , "i" , $titre_url  );
        $titre_url=str_replace  ( "ï"  , "i" , $titre_url  );
        $titre_url=str_replace  ( "Ì"  , "i" , $titre_url  );
        $titre_url=str_replace  ( "Î"  , "i" , $titre_url  );
        $titre_url=str_replace  ( "Ï"  , "i" , $titre_url  );

        $titre_url=str_replace  ( "ò"  , "o" , $titre_url  );
        $titre_url=str_replace  ( "ô"  , "o" , $titre_url  );
        $titre_url=str_replace  ( "ö"  , "o" , $titre_url  );
        $titre_url=str_replace  ( "Ò"  , "o" , $titre_url  );
        $titre_url=str_replace  ( "Ô"  , "o" , $titre_url  );
        $titre_url=str_replace  ( "Ö"  , "o" , $titre_url  );

        $titre_url=str_replace  ( "ù"  , "u" , $titre_url  );
        $titre_url=str_replace  ( "û"  , "u" , $titre_url  );
        $titre_url=str_replace  ( "ü"  , "u" , $titre_url  );
        $titre_url=str_replace  ( "Ù"  , "u" , $titre_url  );
        $titre_url=str_replace  ( "Û"  , "u" , $titre_url  );
        $titre_url=str_replace  ( "Ü"  , "u" , $titre_url  );

        $titre_url=str_replace  ( "@"  , "a" , $titre_url  );
        $titre_url=str_replace  ( "★"  , "-" , $titre_url  );







        foreach ($emptyItem as $item)
        {
            $titre_url=str_replace  ( $item  , "" , $titre_url  );
        }




        $titre_url = urlencode($titre_url);

        return $titre_url;
    }

}