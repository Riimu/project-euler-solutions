<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem31 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->countGroupsWithTotalSum(
            [1, 2, 5, 10, 20, 50, 100, 200],
            200
        );
    }

    public function countGroupsWithTotalSum(array $values, int $sum): int
    {
        $count = 0;

        foreach ($this->iterateTotalSumGroups($values,  $sum) as $_) {
            $count++;
        }

        return $count;
    }

    public function iterateTotalSumGroups(array $values, int $sum): \Generator
    {
        $offset = 0;

        foreach ($values as $value) {
            if ($value === $sum) {
                yield [$value];
            } elseif ($value > $sum) {
                continue;
            }

            foreach ($this->iterateTotalSumGroups(\array_slice($values, $offset++), $sum - $value) as $group) {
                yield [$value, ... $group];
            }
        }
    }
}
