<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\BasicMath;
use Riimu\EulerSolver\Library\FactoringMath;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem12 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->findTriangleWithDivisorCountAbove(500);
    }

    public function findTriangleWithDivisorCountAbove(int $count): int
    {
        $n = 3;
        $nextDivisors = $this->countDivisors(($n + 1) / 2);

        do {
            $n++;
            $divisors = $nextDivisors;
            $nextDivisors = $this->countDivisors($n % 2 === 0 ? $n + 1 : ($n + 1) / 2);
        } while ($divisors * $nextDivisors <= $count);

        return BasicMath::getIntegerSum($n);
    }

    private function countDivisors(int $number): int
    {
        return array_reduce(
            FactoringMath::countFactors($number),
            static fn(int $carry, int $x): int => $carry * ($x + 1),
            1,
        );
    }
}
