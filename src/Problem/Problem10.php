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
class Problem10 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfPrimesBelow(2_000_000);
    }

    public function getSumOfPrimesBelow(int $limit): int
    {
        $sum = 0;

        foreach (PrimeMath::iteratePrimes() as $prime) {
            if ($prime >= $limit) {
                break;
            }

            $sum += $prime;
        }

        return $sum;
    }
}
