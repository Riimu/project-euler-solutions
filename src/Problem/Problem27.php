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
class Problem27 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->findProductOfCoefficientsOfQuadraticFormulaWithMostPrimes(1_000, 1_000);
    }

    public function findProductOfCoefficientsOfQuadraticFormulaWithMostPrimes(int $limitA, int $limitB): int
    {
        $bCandidates = PrimeMath::getPrimesUpTo($limitB);
        $maxPrime = $limitB;
        $primes = array_flip($bCandidates);
        $aPrimes = PrimeMath::getPrimesUpTo(($limitA - 1) + $limitB + 1);

        $resultA = 0;
        $resultB = 0;
        $maxCount = 0;

        foreach ($bCandidates as $b) {
            foreach ($aPrimes as $aPrime) {
                $a = $aPrime - $b - 1;

                if ($a <= -$limitA) {
                    continue;
                }

                if ($a >= $limitA) {
                    break;
                }

                for ($n = 2; true; $n++) {
                    $test = $n ** 2 + $a * $n + $b;

                    if ($test < 0) {
                        break;
                    }

                    if ($test > $maxPrime) {
                        $primes = array_flip(PrimeMath::getPrimesUpTo($test));
                        $maxPrime = $test;
                    }

                    if (!\array_key_exists($test, $primes)) {
                        break;
                    }
                }

                if ($n > $maxCount) {
                    $maxCount = $n;
                    $resultA = $a;
                    $resultB = $b;
                }
            }
        }

        return $resultA * $resultB;
    }
}
