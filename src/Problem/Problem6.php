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
        return (string) $this->sumSquareAndSquareSumDifference(100);
    }

    private function sumSquareAndSquareSumDifference(int $limit): int
    {
        $sumOfSquares = (2 * $limit + 1) * ($limit + 1) * $limit / 6;
        $squareOfSum = ($limit * ($limit + 1) / 2) ** 2;

        return $squareOfSum - $sumOfSquares;
    }
}
