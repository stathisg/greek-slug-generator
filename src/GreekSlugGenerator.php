<?php
namespace StathisG\GreekSlugGenerator;

/**
 * A slug (pretty URL) generator, which supports Greek UTF-8 characters
 *
 * @package StathisG\GreekSlugGenerator
 * @author StathisG (Stathis Goudoulakis, me@stathisg.com)
 * @license MIT
 * @version 2.0.0
 */

class GreekSlugGenerator
{
    /**
    * Generates a slug (pretty url) based on a string, which is typically a page/article title
    *
    * @param string $string
    * @param string $separator
    * @return string the generated slug
    */
    public static function getSlug($string, $separator = '-')
    {
        $slug = '';
        $lastCharacter = '';
        $string = trim(mb_strtolower($string, 'utf-8'));

        for ($i = 0; $i < mb_strlen($string, 'utf-8'); $i++)  {
            $tempCharacter = self::utf8_substr($string, $i, 1);
            $currentCharacter = self::convertCharacter($tempCharacter, $separator);

            if($currentCharacter === '' || ($currentCharacter === $lastCharacter && $currentCharacter === $separator))  {
                continue;
            }

            $lastCharacter = $currentCharacter;
            $slug .= $currentCharacter;
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
    private static function utf8_substr($str, $start, $end)
    {
        preg_match_all('/./su', $str, $ar);

        if(func_num_args() >= 3) {
            $end = func_get_arg(2);
            return join('', array_slice($ar[0], $start, $end));
        }

        return join('', array_slice($ar[0], $start, $end));
    }

    /**
    * Converts a character to a slug-friendly character.
    *
    * If it is a Greek character, converts it to an English equivalent.
    * If it is an English character or a number, returns the same character/number.
    * If it is a space, converts it to the selected separator.
    * If it is a symbol, either translates it to the selected separator (depending on the rules), or just ignores it and returns an empty string.
    *
    * @param string $character
    * @param string $separator
    * @return string the converted character
    */
    protected static function convertCharacter($character, $separator)
    {
        $allowedCharacters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', $separator];

        if (in_array($character, $allowedCharacters)) {
            return $character;
        }

        switch ($character) {
            case ' ':
            case ':':
            case '-':
            case '—':
            case '_':
            case '/':
            case '\\':
                return $separator;
            case 'α':
            case 'ά':
                return 'a';
            case 'β':
                return 'b';
            case 'γ':
                return 'g';
            case 'δ':
                return 'd';
            case 'ε':
            case 'έ':
                return 'e';
            case 'ζ':
                return 'z';
            case 'η':
            case 'ή':
                return 'h';
            case 'θ':
                return 'th';
            case 'ι':
            case 'ί':
            case 'ϊ':
            case 'ΐ':
                return 'i';
            case 'κ':
                return 'k';
            case 'λ':
                return 'l';
            case 'μ':
                return 'm';
            case 'ν':
                return 'n';
            case 'ξ':
                return 'ks';
            case 'ο':
            case 'ό':
                return 'o';
            case 'π':
                return 'p';
            case 'ρ':
                return 'r';
            case 'σ':
            case 'ς':
                return 's';
            case 'τ':
                return 't';
            case 'υ':
            case 'ύ':
            case 'ϋ':
            case 'ΰ':
                return 'y';
            case 'φ':
                return 'f';
            case 'χ':
                return 'x';
            case 'ψ':
                return 'ps';
            case 'ω':
            case 'ώ':
                return 'w';
            default:
                return '';
        }
    }
}
