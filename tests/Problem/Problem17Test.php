<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem17;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem17Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem17();
        self::assertSame('21124', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem17();
        self::assertSame(19, $solver->sumNumberWordsLengthsUpTo(5));
    }

    public function testNumberWordExamples(): void
    {
        $solver = new Problem17();

        self::assertSame('three hundred and forty-two', $solver->getNumberWord(342));
        self::assertSame('one hundred and fifteen', $solver->getNumberWord(115));
    }
}
