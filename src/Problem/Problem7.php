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
class Problem7 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->findNthPrime(10_001);
    }

    private function findNthPrime(int $number): int
    {
        $count = 1;
        $prime = 2;

        foreach (PrimeMath::iteratePrimes() as $prime) {
            if ($count === $number) {
                break;
            }

            $count++;
        }

        return $prime;
    }
}
