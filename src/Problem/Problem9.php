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
class Problem9 implements EulerProblem
{
    public function solve(): string
    {
        return (string) array_product(array_first($this->findPythagoreanTriplets(1000)));
    }

    /**
     * @param int $sum
     * @return list<list<int>>
     */
    public function findPythagoreanTriplets(int $sum): array
    {
        if ($sum % 2 !== 0) {
            return [];
        }

        $triplets = [];

        // Solve via a + b + c = 2 * m * (m + n) * d
        $half = $sum / 2;
        $max = (int) (ceil(sqrt($half))) - 1;

        for ($m = 2; $m <= $max; $m++) {
            if ($half % $m !== 0) {
                continue;
            }

            $sm = $half / $m;

            while ($sm % 2 === 0) {
                $sm /= 2;
            }

            $k = $m % 2 === 1 ? $m + 2 : $m + 1;

            while ($k < 2 * $m && $k <= $sm) {
                if ($sm % $k === 0 && FactoringMath::getGreatestCommonDivisor($k, $m) === 1) {
                    $d = $half / ($k * $m);
                    $n = $k - $m;
                    $a = $d * ($m * $m - $n * $n);
                    $b = 2 * $d * $m * $n;
                    $c = $d * ($m * $m + $n * $n);
                    $triplets[] = [$a, $b, $c];
                }

                $k += 2;
            }
        }

        return $triplets;
    }
}
