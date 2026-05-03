<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem15;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem15Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem15();
        self::assertSame('137846528820', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem15();
        self::assertSame(6, $solver->countGridPaths(2, 2));
    }
}
