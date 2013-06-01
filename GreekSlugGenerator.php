<?php
/**
 * A slug (pretty URL) generator, which supports Greek UTF-8 characters
 *
 * @package GreekSlugGenerator
 * @author StathisG (Stathis Goudoulakis, me@stathisg.com)
 * @license WTFPL Version 2
 * @version 1.0
 */

class GreekSlugGenerator
{
    public function __construct() {}

    /**
    * Generates a slug (pretty url) based on a string, which is typically a page/article title
    *
    * @param string $str
    * @return string the generated slug
    */
    public function get_slug($str)
    {
        $slug = '';
        $last_char = '';
        $current_char = '';
        $str = trim($str);

        for ($i = 0; $i < mb_strlen($str, 'utf-8'); $i++)
        {
            $char = $this->utf8_substr($str, $i, 1);
            $current_char = $this->convert_character($char);
            
            if($current_char === $last_char && $current_char === '-')
            {
                //ignore character
            }
            else
            {
                $slug .= $current_char;
            }

            if(!empty($current_char))
            {
                $last_char = $current_char;
            }
        }
        
        return $slug;
    }

    /**
    * A UTF-8 substr function adapted from the following: http://us.php.net/manual/en/function.substr.php#44838
    *
    * @param string $str
    * @param int $start
    * @param int $end
    * @return string a utf-8 character
    */
    private function utf8_substr($str, $start, $end)
    {
        preg_match_all('/./su', $str, $ar);

        if(func_num_args() >= 3)
        {
            $end = func_get_arg(2);
            return join('', array_slice($ar[0], $start, $end));
        }
        else
        {
            return join('', array_slice($ar[0], $start, $end));
        }
    }

    /**
    * Converts a character to a slug-friendly character.
    *
    * If it is a Greek character, converts it to an English equivalent.
    * If it is an English character or a number, returns the same character/number.
    * If it is a space, converts it to a dash (-) character.
    * If it is a symbol, either translates it to a dash character (depending on the rules), or just ignores it and returns an empty string.
    *
    * @param string $char
    * @return string the converted character
    */
    private function convert_character($char)
    {
        $allowed_characters = array('A', 'a', 'B', 'b', 'C', 'c', 'D', 'd', 'E', 'e', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'Q', 'q', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-');

        if ($char === ' ' || $char === ':' || $char === '–' || $char === '_' || $char === '/' || $char === '\\')
        {
            return '-';
        }
        else if (in_array($char, $allowed_characters))
        {
            return strtolower($char);
        }
        else if ($char=='Α' || $char=='α' || $char=='Ά' || $char=='ά')
        {
            return 'a';
        }
        else if ($char=='Β' || $char=='β')
        {
            return 'b';
        }
        else if ($char=='Γ' || $char=='γ')
        {
            return 'g';
        }
        else if ($char=='Δ' || $char=='δ')
        {
            return 'd';
        }
        else if ($char=='Ε' || $char=='ε' || $char=='Έ' || $char=='έ')
        {
            return 'e';
        }
        else if ($char=='Ζ' || $char=='ζ')
        {
            return 'z';
        }
        else if ($char=='Η' || $char=='η' || $char=='Ή' || $char=='ή')
        {
            return 'h';
        }
        else if ($char=='Θ' || $char=='θ')
        {
            return 'th';
        }
        else if ($char=='Ι' || $char=='ι' || $char=='Ί' || $char=='ί' || $char=='ϊ' || $char=='ΐ')
        {
            return 'i';
        }
        else if ($char=='Κ' || $char=='κ')
        {
            return 'k';
        }
        else if ($char=='Λ' || $char=='λ')
        {
            return 'l';
        }
        else if ($char=='Μ' || $char=='μ')
        {
            return 'm';
        }
        else if ($char=='Ν' || $char=='ν')
        {
            return 'n';
        }
        else if ($char=='Ξ' || $char=='ξ')
        {
            return 'ks';
        }
        else if ($char=='Ο' || $char=='ο' || $char=='Ό' || $char=='ό')
        {
            return 'o';
        }
        else if ($char=='Π' || $char=='π')
        {
            return 'p';
        }
        else if ($char=='Ρ' || $char=='ρ')
        {
            return 'r';
        }
        else if ($char=='Σ' || $char=='σ' || $char=='ς')
        {
            return 's';
        }
        else if ($char=='Τ' || $char=='τ')
        {
            return 't';
        }
        else if ($char=='Υ' || $char=='υ' || $char=='Ύ' || $char=='ύ' || $char=='ϋ')
        {
            return 'y';
        }
        else if ($char=='Φ' || $char=='φ')
        {
            return 'f';
        }
        else if ($char=='Χ' || $char=='χ')
        {
            return 'x';
        }
        else if ($char=='Ψ' || $char=='ψ')
        {
            return 'ps';
        }
        else if ($char=='Ω' || $char=='ω' || $char=='Ώ' || $char=='ώ')
        {
            return 'w';
        }
        else
        {
            return '';
        }
    }
}
?>