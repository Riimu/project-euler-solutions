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
        return (string) $this->getSumOfNumbersDivisibleBelow(3, 5, 1_000);
    }

    public function getSumOfNumbersDivisibleBelow(int $first, int $second, int $limit): int
    {
        $max = $limit - 1;

        return
            $this->sumDivisibleBy($first, $max)
            + $this->sumDivisibleBy($second, $max)
            - $this->sumDivisibleBy($first * $second, $max);
    }

    private function sumDivisibleBy(int $divisor, int $max): int
    {
        $count = intdiv($max, $divisor);
        return intdiv($divisor * ($count * ($count + 1)), 2);
    }
}
