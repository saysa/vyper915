<?php

namespace Vyper\SiteBundle\Components\Wordwrap;

class Wordwrap {

    /**
     * Get a teaser finished by a dot.
     * @param $string
     * @param int $nb_characters
     * @return string
     */
    public function cut($string, $nb_characters = 255)
    {
        if ($string != '') {
            $first = $this->getFirstPart($string, $nb_characters);
            $second = $this->getSecondPart($first, $string);

            return $first.$second;
        } else {
            return $string;
        }

    }

    public function cutElypse($string, $nb_characters)
    {
        //no need to trim, already shorter than trim length
        if (strlen($string) <= $nb_characters) {
            return $string;
        }

        $string = $this->getFirstPart($string, $nb_characters, true, true);
        return $string;
    }

    private function getSecondPart($cut_string, $string)
    {
        $pattern = '~'.trim($cut_string).'~';
        $part2 = preg_replace($pattern, '', strip_tags($string));
        $dot_pos = strpos($part2, '.');
        $string = substr($part2,0,$dot_pos+1);

        return $string;
    }

    private function getFirstPart($input, $length, $strip_html = true, $elypse = false)
    {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        if ($elypse) {
            $trimmed_text = $trimmed_text . "...";
        }

        return $trimmed_text;
    }
} 