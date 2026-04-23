<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\FactoringMath;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem5 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSmallestDivisible(range(1, 20));
    }

    /**
     * @param list<int> $numbers
     * @return int
     */
    private function getSmallestDivisible(array $numbers): int
    {
        $commonFactors = [];

        foreach ($numbers as $number) {
            $factors = array_count_values(FactoringMath::getFactors($number));

            foreach ($factors as $factor => $count) {
                if (!isset($commonFactors[$factor]) || $count > $commonFactors[$factor]) {
                    $commonFactors[$factor] = $count;
                }
            }
        }

        $product = 1;

        foreach ($commonFactors as $factor => $count) {
            $product *= $factor ** $count;
        }

        return $product;
    }
}
