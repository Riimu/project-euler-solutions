<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem6 implements EulerProblem
{
    public function solve(): string
    {
        $range = range(1, 100);
        $sumOfSquares = array_reduce($range, static fn (int $carry, int $item) => $carry + $item * $item, 0);
        $squareOfSum = array_sum($range) ** 2;

        return (string) abs($sumOfSquares - $squareOfSum);
    }
}
