<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem17 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->sumNumberWordsLengthsUpTo(1000);
    }

    public function sumNumberWordsLengthsUpTo(int $limit): int
    {
        $sum = 0;

        for ($i = 1; $i <= $limit; $i++) {
            $word = $this->getNumberWord($i);
            $word = preg_replace('/[- ]/', '', $word);
            $sum += \strlen($word);
        }

        return $sum;
    }


    public function getNumberWord(int $number): string
    {
        if ($number === 0) {
            return 'zero';
        }

        $scales = ['thousand', 'million', 'billion', 'trillion', 'quadrillion'];
        $hundred = 'hundred';
        $and = 'and';
        $tens = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
        $teens = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
        $ones = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

        $words = [];

        for ($i = 0; $number > 0; $i++) {
            $section = $number % 1000;
            $number = intdiv($number, 1000);

            $hundreds = intdiv($section, 100);
            $section %= 100;

            if ($i > 0) {
                $words[] = $scales[$i - 1];
            }

            if ($section > 0) {
                if ($section < 10) {
                    $words[] = $ones[$section - 1];
                } elseif ($section < 20) {
                    $words[] = $teens[$section - 10];
                } else {
                    $words[] = $section % 10 === 0
                        ? $tens[intdiv($section, 10) - 2]
                        : \sprintf('%s-%s', $tens[intdiv($section, 10) - 2], $ones[$section % 10 - 1]);
                }
            }

            if ($hundreds > 0) {
                if ($section > 0) {
                    $words[] = $and;
                }

                $words[] = $hundred;
                $words[] = $ones[$hundreds - 1];
            }
        }

        return implode(' ', array_reverse($words));
    }
}
