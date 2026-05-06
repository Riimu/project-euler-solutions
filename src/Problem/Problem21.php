<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\PrimeMath;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem21 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfAmicableNumbersBelow(10000);
    }

    public function getSumOfAmicableNumbersBelow(int $limit): int
    {
        $sums = [];
        $total = 0;

        for ($a = 2; $a < $limit; $a++) {
            if (\array_key_exists($a, $sums)) {
                continue;
            }

            $b = $this->getSumOfProperDivisors($a);

            if ($b <= $a) {
                continue;
            }

            $sums[$a] = $b;

            if (\array_key_exists($b, $sums)) {
                $bSum = $sums[$b];
            } else {
                $bSum = $this->getSumOfProperDivisors($b);
                $sums[$b] = $bSum;
            }

            if ($a === $bSum) {
                $total += $a;

                if ($b < $limit) {
                    $total += $b;
                }
            }
        }

        return $total;
    }

    public function getSumOfProperDivisors(int $number): int
    {
        $sum = 1;

        foreach (PrimeMath::countFactors($number) as $prime => $count) {
            $sum *= intdiv($prime ** ($count + 1) - 1, $prime - 1);
        }

        return $sum - $number;
    }
}
