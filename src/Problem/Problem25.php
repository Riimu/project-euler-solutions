<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem25 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getFirstFibonacciWithDigits(1_000);
    }

    public function getFirstFibonacciWithDigits(int $count): int
    {
        $previous = gmp_init(1);
        $current = gmp_init(1);

        for ($i = 2; true; $i++) {
            $result = gmp_strval($current);

            if (\strlen($result) === $count) {
                break;
            }

            [$previous, $current] = [$current, gmp_add($previous, $current)];
        }

        return $i;
    }
}
