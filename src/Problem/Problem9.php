<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem9 implements EulerProblem
{
    public function solve(): string
    {
        return (string) array_product(array_first($this->findPythagoreanTriplets(1000)));
    }

    /**
     * @param int $number
     * @return list<list<int>>
     */
    public function findPythagoreanTriplets(int $number): array
    {
        $triplets = [];

        for ($i = 1; $i * 3 + 3 <= $number; $i++) {
            for ($j = $i + 1; $i + $j * 2 + 1 <= $number; $j++) {
                if ($i ** 2 + $j ** 2 === ($number - $i - $j) ** 2) {
                    $triplets[] = [$i, $j, $number - $i - $j];
                }
            }
        }

        return $triplets;
    }
}
