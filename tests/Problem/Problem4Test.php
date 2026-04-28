<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem4;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem4Test extends TestCase
{
    public function testProblem2Solution(): void
    {
        $solver = new Problem4();
        self::assertSame('906609', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem4();
        self::assertSame(9009, $solver->getLargestPalindromeOfProduct(10, 99));
    }
}
