<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem30 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfNumbersThatAreSumsOfDigitPowers(5);
    }

    public function getSumOfNumbersThatAreSumsOfDigitPowers(int $power): int
    {
        $sum = 0;
        $maxDigits = 1;

        while ($maxDigits * 9 ** $power > 10 ** $maxDigits) {
            $maxDigits++;
        }

        foreach ($this->iterateUniqueGroups(range(0, 9), $maxDigits) as $group) {
            $powerSum = array_reduce($group, static fn(int $carry, int $item): int => $carry + $item ** $power, 0);
            $powerSumDigits = count_chars(str_pad((string) $powerSum, $maxDigits, '0', \STR_PAD_LEFT), 1);
            $groupDigits = count_chars(implode('', $group), 1);

            if ($powerSumDigits === $groupDigits && $powerSum > 1) {
                $sum += $powerSum;
            }
        }

        return $sum;
    }

    /**
     * @template T of mixed
     * @param array<T> $items
     * @param int $amount
     * @return \Generator<list<T>>
     */
    public function iterateUniqueGroups(array $items, int $amount): \Generator
    {
        if ($amount < 2) {
            foreach ($items as $item) {
                yield [$item];
            }

            return;
        }

        $offset = 0;

        foreach ($items as $item) {
            foreach ($this->iterateUniqueGroups(\array_slice($items, $offset++), $amount - 1) as $group) {
                yield [$item, ... $group];
            }
        }
    }
}
