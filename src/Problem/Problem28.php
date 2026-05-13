<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem28 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfDiagonalsInSquareSpiral(1_001);
    }

    public function getSumOfDiagonalsInSquareSpiral(int $size): int
    {
        $sum = 1;
        $steps = 1;

        for ($length = 2; $length < $size; $length += 2) {
            for ($i = 0; $i < 4; $i++) {
                $steps += $length;
                $sum += $steps;
            }
        }

        return $sum;
    }
}
