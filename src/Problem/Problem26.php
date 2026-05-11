<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem26 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->findLongestRepeatingFractionBelow(1000);
    }

    public function findLongestRepeatingFractionBelow(int $limit): int
    {
        $result = -1;
        $max = 0;

        for ($i = 2; $i < $limit; $i++) {
            $length = $this->findRepeatLength($i);

            if ($length > $max) {
                $max = $length;
                $result = $i;
            }
        }

        return $result;
    }

    public function findRepeatLength(int $denominator): int
    {
        $position = 1;
        $reminders = [];
        $reminder = 10;

        while (!\array_key_exists($reminder, $reminders)) {
            $reminders[$reminder] = $position++;
            $reminder %= $denominator;

            if ($reminder === 0) {
                return -1;
            }

            $reminder *= 10;
        }

        return $position - $reminders[$reminder];
    }
}
