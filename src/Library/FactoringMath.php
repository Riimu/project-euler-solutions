<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Library;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class FactoringMath
{
    /**
     * @param int $number
     * @return list<int>
     */
    public static function getFactors(int $number): array
    {
        $factors = [];
        $maxFactor = (int) sqrt($number);

        foreach (PrimeMath::iteratePrimes() as $prime) {
            if ($prime > $maxFactor) {
                $factors[] = $number;
                break;
            }

            while ($number % $prime === 0) {
                $factors[] = $prime;
                $number /= $prime;

                if ($number === 1) {
                    break 2;
                }

                $maxFactor = (int) sqrt($number);
            }
        }

        return $factors;
    }
}
