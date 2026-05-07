<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem22 implements EulerProblem
{
    public function solve(): string
    {
        $file = file_get_contents(self::INPUT_DIR . '/0022_names.txt');

        if (!\is_string($file)) {
            throw new \UnexpectedValueException('Could not read input file');
        }

        $names = str_getcsv($file, ',', '"', '');

        if (\in_array(null, $names, true)) {
            throw new \UnexpectedValueException('Invalid input file contents');
        }

        return (string) $this->getTotalNameScore($names);
    }

    /**
     * @param list<string> $names
     * @return int
     */
    public function getTotalNameScore(array $names): int
    {
        sort($names);
        $total = 0;

        foreach ($names as $position => $name) {
            $total += $this->getNameScore($name, $position + 1);
        }

        return $total;
    }

    public function getNameScore(string $name, int $position): int
    {
        $length = \strlen($name);
        $score = 0;

        for ($i = 0; $i < $length; $i++) {
            $score += \ord($name[$i]) - 64;
        }

        return $score * $position;
    }
}
