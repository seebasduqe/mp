<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * IBAN validation
 * @filename: iban_validation.class.php
 * Location: _app/_models/_class
 * @Creator: J. Raya (RBM) <info@novaigrup.com>
 * 	20150805 JRM Created
 */
class IbanValidation extends Model
{

    /**
     * Validate IBAN
     * @param string $iban IBAN
     * @return bool
     * @access public static
     */
    public static function validate($iban)
    {

        $iban = str_replace(' ', '', $iban);

        if (strlen($iban) != 24)
            return false;

        $iban_start = substr($iban, 0, 4);
        $account = substr($iban, 4);

        $letters = substr($iban_start, 0, 2);
        $num_letter1 = self::convertLetterToNumber(substr($iban_start, 0, 1));
        $num_letter2 = self::convertLetterToNumber(substr($iban_start, 1, 1));

        $dividend = $account . $num_letter1 . $num_letter2 . '00';
        $control_code = 98 - self::my_bcmod($dividend, '97');
        if (strlen($control_code) == 1)
            $control_code = '0' . $control_code;

        $calculated_iban = $letters . $control_code . $account;

        if ($calculated_iban == $iban)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Convert letter to number
     * @param string $letter Letter
     * @return integer Number equivalence
     * @access private
     */
    private static function convertLetterToNumber($letter)
    {
        $index = 0;
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $index = strpos($letters, strtoupper($letter));
        $index = $index + 10;

        return $index;
    }

    /**
     * Emulate BCMOD php
     * @param integer $x Left operand 
     * @param integer $y Modulus
     * @return integer
     */
    private static function my_bcmod($x, $y)
    {
        // how many numbers to take at once? carefull not to exceed (int)
        $take = 5;
        $mod = '';

        do
        {
            $a = (int) $mod . substr($x, 0, $take);
            $x = substr($x, $take);
            $mod = $a % $y;
        } while (strlen($x));

        return (int) $mod;
    }
}
