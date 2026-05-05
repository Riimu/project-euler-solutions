<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem19 implements EulerProblem
{
    private const int SUNDAY = 7;

    public function solve(): string
    {
        return (string) $this->countSundaysOnFirstOfMonth(
            new \DateTimeImmutable('1 Jan 1901'),
            new \DateTimeImmutable('31 Dec 2000'),
        );
    }

    public function countSundaysOnFirstOfMonth(\DateTimeImmutable $start, \DateTimeImmutable $end): int
    {
        $count = 0;
        $date = $start;

        while ($date <= $end) {
            if ($this->isSunday($date)) {
                $count++;
            }

            $date = $date->modify('first day of next month');
        }

        return $count;
    }

    private function isSunday(\DateTimeImmutable $date): bool
    {
        $weekday = (int) $date->format('N');

        return $weekday === self::SUNDAY;
    }
}
