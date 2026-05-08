<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\DivisorMath;

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

            $b = DivisorMath::getSumOfProperDivisors($a);

            if ($b <= $a) {
                continue;
            }

            $sums[$a] = $b;

            if (\array_key_exists($b, $sums)) {
                $bSum = $sums[$b];
            } else {
                $bSum = DivisorMath::getSumOfProperDivisors($b);
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


}
