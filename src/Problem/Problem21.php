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
        $sums = array_fill(0, $limit, 0);
        $total = 0;

        for ($a = 2; $a < $limit; $a++) {
            if ($sums[$a] !== 0) {
                continue;
            }

            $b = $this->getSumOfProperDivisors($a);

            if ($b >= $limit) {
                continue;
            }

            $sums[$a] = $b;

            if ($a === $b) {
                continue;
            }

            if ($sums[$b] === 0) {
                $bSum = $this->getSumOfProperDivisors($b);
                $sums[$b] = $bSum;
            } else {
                $bSum = $sums[$b];
            }

            if ($a === $bSum) {
                $total += $a + $b;
            }
        }

        return $total;
    }

    public function getSumOfProperDivisors(int $number): int
    {
        return array_sum($this->getProperDivisors($number));
    }

    public function getProperDivisors(int $number): array
    {
        $maxDivisor = (int) sqrt($number);
        $ascending = [1];
        $descending = [];

        for ($i = 2; $i <= $maxDivisor; $i++) {
            if ($number % $i === 0) {
                $ascending[] = $i;
                array_unshift($descending, intdiv($number, $i));
            }
        }

        array_push($ascending, ... $descending);

        return $ascending;
    }
}
