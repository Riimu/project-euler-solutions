<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Library;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class DivisorMath
{
    public static function getSumOfProperDivisors(int $number): int
    {
        $sum = 1;

        foreach (PrimeMath::countFactors($number) as $prime => $count) {
            $sum *= intdiv($prime ** ($count + 1) - 1, $prime - 1);
        }

        return $sum - $number;
    }
}
