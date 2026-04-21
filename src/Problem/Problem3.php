<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem3 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getHighestFactor(600_851_475_143);
    }

    private function getHighestFactor(int $number): int
    {
        return array_last($this->getFactors($number));
    }

    /**
     * @param int $number
     * @return list<int>
     */
    private function getFactors(int $number): array
    {
        $factors = [];
        $maxFactor = (int) sqrt($number);

        foreach ($this->nextPrime() as $prime) {
            if ($prime > $maxFactor) {
                $factors[] = $number;
                break;
            }

            while ($number % $prime === 0) {
                $factors[] = $prime;
                $number /= $prime;

                if ($number === 1) {
                    break 2;
                }

                $maxFactor = (int) sqrt($number);
            }
        }

        return $factors;
    }

    private function nextPrime(): \Generator
    {
        yield 2;
        yield 3;
        yield 5;

        $primes = [3, 5];
        $test = 7;

        while (true) {
            $maxFactor = (int) sqrt($test);
            $isPrime = true;

            foreach ($primes as $prime) {
                if ($prime > $maxFactor) {
                    break;
                }

                if ($test % $prime === 0) {
                    $isPrime = false;
                    break;
                }
            }

            if ($isPrime) {
                $primes[] = $test;
                yield $test;
            }

            $test += $test % 10 === 3 ? 4 : 2;
        }
    }
}
