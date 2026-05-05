<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\StringLib;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem17 implements EulerProblem
{
    private const string WORD_HUNDRED = 'hundred';
    private const string WORD_AND = 'and';
    private const array WORD_SCALES = ['', 'thousand', 'million', 'billion', 'trillion', 'quadrillion'];
    private const array WORD_TENS = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    private const array WORD_ONES = [
        'zero',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
        'ten',
        'eleven',
        'twelve',
        'thirteen',
        'fourteen',
        'fifteen',
        'sixteen',
        'seventeen',
        'eighteen',
        'nineteen',
    ];

    public function solve(): string
    {
        return (string) $this->sumNumberWordsLengthsUpTo(1000);
    }

    public function sumNumberWordsLengthsUpTo(int $limit): int
    {
        $sum = 0;

        for ($i = 1; $i <= $limit; $i++) {
            $word = $this->getNumberWord($i);
            $word = StringLib::replace('/[- ]/', '', $word);
            $sum += \strlen($word);
        }

        return $sum;
    }

    public function getNumberWord(int $number): string
    {
        if ($number === 0) {
            return self::WORD_ONES[0];
        }

        $words = [];

        for ($i = 0; $number > 0; $i++) {
            $section = $number % 1000;
            $number = intdiv($number, 1000);

            $hundreds = intdiv($section, 100);
            $section %= 100;

            if ($i > 0) {
                $words[] = self::WORD_SCALES[$i];
            }

            if ($section > 0) {
                if ($section < 20) {
                    $words[] = self::WORD_ONES[$section];
                } elseif ($section % 10 === 0) {
                    $words[] = self::WORD_TENS[intdiv($section, 10)];
                } else {
                    $words[] = \sprintf(
                        '%s-%s',
                        self::WORD_TENS[intdiv($section, 10)],
                        self::WORD_ONES[$section % 10],
                    );
                }
            }

            if ($hundreds > 0) {
                if ($section > 0) {
                    $words[] = self::WORD_AND;
                }

                $words[] = self::WORD_HUNDRED;
                $words[] = self::WORD_ONES[$hundreds];
            }
        }

        return implode(' ', array_reverse($words));
    }
}
