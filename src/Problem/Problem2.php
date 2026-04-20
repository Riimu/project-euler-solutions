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
        $previous = 1;
        $current = 2;
        $sum = 0;

        while ($current < 4_000_000) {
            if ($current % 2 === 0) {
                $sum += $current;
            }

            [$previous, $current] = [$current, $previous + $current];
        }

        return (string) $sum;
    }
}
