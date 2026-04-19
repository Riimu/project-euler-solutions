<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem1 implements EulerProblem
{
    public function solve(): string
    {
        $multiplies = [];

        for ($i = 1; $i < 1000; $i++) {
            if ($i % 3 === 0 || $i % 5 === 0) {
                $multiplies[] = $i;
            }
        }

        return (string)array_sum($multiplies);
    }
}
