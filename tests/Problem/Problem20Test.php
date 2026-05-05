<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem20;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem20Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem20();
        self::assertSame('648', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem20();
        self::assertSame(27, $solver->sumDigitsInFactorial(10));
    }
}
