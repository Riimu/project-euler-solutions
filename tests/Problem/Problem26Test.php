<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem26;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem26Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem26();
        self::assertSame('983', $solver->solve());
    }

    public function testFindRepeatLength(): void
    {
        $solver = new Problem26();
        self::assertSame(6, $solver->findRepeatLength(7));
    }
}
