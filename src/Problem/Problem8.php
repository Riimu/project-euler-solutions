<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem8 implements EulerProblem
{
    private const string DIGITS = <<<'DIGITS'
        7316717653133062491922511967442657474235534919493496983520312774506326239578318016984801869478851843
        8586156078911294949545950173795833195285320880551112540698747158523863050715693290963295227443043557
        6689664895044524452316173185640309871112172238311362229893423380308135336276614282806444486645238749
        3035890729629049156044077239071381051585930796086670172427121883998797908792274921901699720888093776
        6572733300105336788122023542180975125454059475224352584907711670556013604839586446706324415722155397
        5369781797784617406495514929086256932197846862248283972241375657056057490261407972968652414535100474
        8216637048440319989000889524345065854122758866688116427171479924442928230863465674813919123162824586
        1786645835912456652947654568284891288314260769004224219022671055626321111109370544217506941658960408
        0719840385096245544436298123098787992724428490918884580156166097919133875499200524063689912560717606
        0588611646710940507754100225698315520005593572972571636269561882670428252483600823257530420752963450
        DIGITS;

    public function solve(): string
    {
        return (string) $this->findLargestProductInNumber(
            preg_replace('/\s+/', '', self::DIGITS),
            13
        );
    }

    private function findLargestProductInNumber(string $number, int $count): int
    {
        $maxProduct = 0;
        $length = \strlen($number);
        $digits = [];

        for ($i = 0; $i < $length; $i++) {
            $next = (int) $number[$i];

            if ($next === 0) {
                $digits = [];
                continue;
            }

            $digits[] = $next;

            if (\count($digits) === $count) {
                $maxProduct = max(array_product($digits), $maxProduct);
                array_shift($digits);
            }
        }

        return $maxProduct;
    }
}
