<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem8;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem8Test extends TestCase
{
    public function testProblem2Solution(): void
    {
        $solver = new Problem8();
        self::assertSame('23514624000', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem8();
        self::assertSame(5832, $solver->findLargestProductInNumber(Problem8::DIGITS, 4));
    }
}
