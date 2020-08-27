<?php
/**
 * Plural library main class
 *
 * @author O.P.Shumilin <ops1@tpu.ru>
 *
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Plural;

/**
 * Class Plural
 * @package Plural
 */
class Plural
{
    /**
     * Vowel values array
     */
    const VOWEL = [
        'a',
        'e',
        'i',
        'o',
        'u',
        'y'
    ];

    /**
     * Consonant values array
     */
    const CONSONANT = [
        'b',
        'c',
        'd',
        'f',
        'g',
        'h',
        'j',
        'k',
        'l',
        'm',
        'n',
        'p',
        'q',
        'r',
        's',
        't',
        'v',
        'w',
        'x',
        'z'
    ];

    /**
     * Exlusions words array
     */
    const EXCLUSIONS = [
        'man'     => 'men',
        'woman'   => 'women',
        'child'   => 'children',
        'person'  => 'people',
        'mouse'   => 'mice',
        'ox'      => 'oxen',
        'foot'    => 'feet',
        'tooth'   => 'teeth',
        'goose'   => 'geese',
        'sheep'   => 'sheep',
        'deer'    => 'deer',
        'fish'    => 'fish',
        'series'  => 'series',
        'species' => 'species',
        'piano'   => 'pianos',
        'photo'   => 'photos',
        'roof'    => 'roofs',
        'cliff'   => 'cliffs',
    ];

    /**
     * Transform to plural form
     *
     * @param string $s
     * @return string
     */
    public static function go(string $s): string
    {
        $s = strtolower($s);

        if (array_key_exists($s, self::EXCLUSIONS)) {
            return self::EXCLUSIONS[$s];
        }
        if (in_array($s, self::EXCLUSIONS)) {
            return $s;
        }

        $sub = substr($s, -2);

        if ($sub == 'es') {
            return $s;
        }

        if (strlen($sub) > 1) {
            $f = substr($sub, 0, 1);
            $l = substr($sub, 1);

            if (in_array($l, ['s', 'x', 'z']) || in_array($sub, ['ch', 'sh'])) {
                if ($l == 'z') {
                    return $s . 'zes';
                }

                return $s . 'es';
            }
            if ($l == 'f') {
                return substr($s, 0, -1) . 'ves';
            }
            if ($sub == 'fe') {
                return substr($s, 0, -2) . 'ves';
            }
            if (self::isConsonant($f) && $l == 'y') {
                return substr($s, 0, -1) . 'ies';
            }
            if (self::isConsonant($f) && $l == 'o') {
                return $s . 'es';
            }

            return $s . 's';
        }

        return $s;
    }

    /**
     * Check letter for vowel
     *
     * @param string $s
     * @return bool
     */
    private static function isVowel(string $s): bool
    {
        if (in_array($s, self::VOWEL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check letter for consonant
     *
     * @param string $s
     * @return bool
     */
    private static function isConsonant(string $s): bool
    {
        if (in_array($s, self::CONSONANT)) {
            return true;
        } else {
            return false;
        }
    }
}