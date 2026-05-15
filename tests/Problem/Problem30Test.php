<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem30;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem30Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem30();
        self::assertSame('443839', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem30();
        self::assertSame(19316, $solver->getSumOfNumbersThatAreSumsOfDigitPowers(4));
    }
}
