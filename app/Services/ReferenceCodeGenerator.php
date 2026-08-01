<?php

namespace App\Services;

class ReferenceCodeGenerator
{
    private static string $alphabet = '9876543210XWRKTVNHPMFDCBAQGJEUYL';

    /**
     * Generate a unique reference/booking code based on database ID.
     */
    public static function generate(int|string $id, string $prefix = 'FMW'): string
    {
        $id = (int) $id;
        $base = strlen(self::$alphabet);

        // Modulo is 32^6 = 1,073,741,824.
        $modulo = 1073741824;

        if ($id <= $modulo) {
            // Keep original 6-character output for IDs <= 1,073,741,824
            $multiplier = 387420489;
            $obfuscated = ($id * $multiplier) % $modulo;

            $code = '';
            $val = $obfuscated;
            for ($i = 0; $i < 6; $i++) {
                $rem = $val % $base;
                $code = self::$alphabet[$rem].$code;
                $val = intval($val / $base);
            }

            return $prefix.$code;
        }

        // For IDs > 1,073,741,824, let it grow to 7+ characters
        // We subtract the modulo to map starting from 0
        $val = $id - $modulo - 1;

        // Obfuscate using a bijection on larger space
        $val = $val ^ 98765432109876;
        $val = ($val + 12345678901234) & 0x7FFFFFFFFFFFFFFF;
        $val = $val ^ 555555555555555;

        $code = '';
        while ($val > 0) {
            $rem = $val % $base;
            $code = self::$alphabet[$rem].$code;
            $val = intval($val / $base);
        }

        // Pad to at least 7 characters to prevent overlap with 6-char domain
        return $prefix.str_pad($code, 7, self::$alphabet[0], STR_PAD_LEFT);
    }
}
