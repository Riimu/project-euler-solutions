<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\DivisorMath;
use Riimu\EulerSolver\Library\PrimeMath;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem5 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSmallestDivisible(range(2, 20));
    }

    /**
     * @param list<int> $numbers
     * @return int
     */
    public function getSmallestDivisible(array $numbers): int
    {
        $commonFactors = [];

        foreach ($numbers as $number) {
            foreach (DivisorMath::getPrimeFactors($number) as $factor => $count) {
                $commonFactors[$factor] = max($commonFactors[$factor] ?? 0, $count);
            }
        }

        $product = 1;

        foreach ($commonFactors as $factor => $count) {
            $product *= $factor ** $count;
        }

        return $product;
    }
}
