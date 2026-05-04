<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem16 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSecondPowerDigitSum(1000);
    }

    public function getSecondPowerDigitSum(int $power): int
    {
        return gmp_pow(gmp_init(2), $power)
            |> gmp_strval(...)
            |> str_split(...)
            |> (static fn(array $x): array => array_map(intval(...), $x))
            |> array_sum(...);
    }
}
