<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem4 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->findLargestPalindrome(100, 999);
    }

    private function findLargestPalindrome(int $min, int $max): int
    {
        $largest = 0;

        for ($i = $max; $i >= $min; $i--) {
            if ($i * $i <= $largest) {
                break;
            }

            for ($j = $i; $j >= $min; $j--) {
                $product = $i * $j;

                if ($product <= $largest) {
                    break;
                }

                if ($this->isPalindrome((string) $product)) {
                    $largest = $product;
                    break;
                }
            }
        }

        return $largest;
    }

    private function isPalindrome(string $text): bool
    {
        return $text === strrev($text);
    }
}
