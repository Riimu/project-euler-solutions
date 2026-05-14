<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem29 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getDistinctPowers(100);
    }

    public function getDistinctPowers(int $limits): int
    {
        $distinct = [];

        for ($i = 2; $i <= $limits; $i++) {
            for ($j = 2; $j <= $limits; $j++) {
                $distinct[gmp_strval(gmp_pow($i, $j))] = true;
            }
        }

        return \count($distinct);
    }
}
