<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem20 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->sumDigitsInFactorial(100);
    }

    public function sumDigitsInFactorial(int $number): int
    {
        return gmp_init($number)
            |> gmp_fact(...)
            |> gmp_strval(...)
            |> str_split(...)
            |> (static fn(array $x): array => array_map(intval(...), $x))
            |> array_sum(...);
    }
}
