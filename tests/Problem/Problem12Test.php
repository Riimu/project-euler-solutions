<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem12;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem12Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem12();
        self::assertSame('76576500', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem12();
        self::assertSame(28, $solver->findTriangleWithDivisorCountAbove(5));
    }
}
