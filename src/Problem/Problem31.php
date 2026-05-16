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
            200,
        );
    }

    /**
     * @param list<int> $coins
     * @param int $amount
     * @return int
     */
    public function countGroupsWithTotalSum(array $coins, int $amount): int
    {
        $ways = array_fill(0, $amount + 1, 0);
        $ways[0] = 1;

        foreach ($coins as $coin) {
            for ($i = $coin; $i <= $amount; $i++) {
                $ways[$i] += $ways[$i - $coin];
            }
        }

        return $ways[$amount];
    }
}
