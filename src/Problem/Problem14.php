<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem14 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->findLongestCollatzChain(1_000_000);
    }

    public function findLongestCollatzChain(int $limit): int
    {
        $sequences = array_fill(0, $limit, 0);
        $sequences[1] = 1;

        $resultKey = 0;
        $maxLength = 0;

        for ($start = 2; $start < $limit; $start++) {
            $length = 0;
            $next = $start;

            do {
                $length++;

                if ($next & 1) {
                    $next += ($next << 1) + 1;
                } else {
                    $next >>= 1;
                }
            } while ($next > $start);

            $length += $sequences[$next];
            $sequences[$start] = $length;

            if ($length > $maxLength) {
                $maxLength = $length;
                $resultKey = $start;
            }
        }

        return $resultKey;
    }
}
