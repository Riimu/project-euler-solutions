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
        $max = 0;

        for ($i = 999; $i > 0; $i--) {
            if ($i * $i < $max) {
                break;
            }

            for ($j = $i; $j > 0; $j--) {
                $product = $i * $j;

                if ($product < $max) {
                    break;
                }

                if ($this->isPalindrome((string) $product)) {
                    $max = $product;
                    break;
                }
            }
        }

        return (string) $max;
    }

    private function isPalindrome(string $text): bool
    {
        return $text === strrev($text);
    }
}
