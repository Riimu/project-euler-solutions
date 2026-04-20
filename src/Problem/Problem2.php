<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem2 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfEvenFibonacciUpTo(4_000_000 - 1);
    }

    private function getSumOfEvenFibonacciUpTo(int $max): int
    {
        if ($max < 3) {
            return 0;
        }

        $previous = 2;
        $current = 8;
        $sum = 2;

        while ($current <= $max) {
            $sum += $current;
            [$previous, $current] = [$current, 4 * $current + $previous];
        }

        return $sum;
    }
}
