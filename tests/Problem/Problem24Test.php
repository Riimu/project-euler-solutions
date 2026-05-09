<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem24;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem24Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem24();
        self::assertSame('2783915460', $solver->solve());
    }

    /**
     * @param list<string> $items
     * @param int $permutation
     * @param string $result
     * @return void
     */
    #[DataProvider('getLexicographicPermutationTestCases')]
    public function testLexicographicPermutations(array $items, int $permutation, string $result): void
    {
        $solver = new Problem24();
        self::assertSame($result, $solver->getLexicographicPermutation($items, $permutation));
    }

    /**
     * @return list<array{list<string>, int, string}>
     */
    public static function getLexicographicPermutationTestCases(): array
    {
        $items = ['0', '1', '2'];

        return [
            [$items, 1, '012'],
            [$items, 2, '021'],
            [$items, 3, '102'],
            [$items, 4, '120'],
            [$items, 5, '201'],
            [$items, 6, '210'],
        ];
    }
}
