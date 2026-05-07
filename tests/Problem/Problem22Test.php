<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem22;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem22Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem22();
        self::assertSame('871198282', $solver->solve());
    }

    public function testGetNameScore(): void
    {
        $solver = new Problem22();
        self::assertSame(49714, $solver->getNameScore('COLIN', 938));
    }
}
