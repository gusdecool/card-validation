<?php

namespace AppBundle\Utility;

class AlgorithmUtility
{

    /**
     * @param string $number
     * @return bool
     */
    public function isValidLuhnAlgorithm($number)
    {
        settype($number, 'string');
        $sumTable = [
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [0, 2, 4, 6, 8, 1, 3, 5, 7, 9]
        ];
        $sum = 0;
        $flip = 0;
        
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $sum += $sumTable[$flip++ % 2][$number[$i]];
        }

        return $sum % 10 === 0;
    }
}
