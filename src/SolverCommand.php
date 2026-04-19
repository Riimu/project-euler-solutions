<?php

declare(strict_types=1);

namespace Riimu\EulerSolver;

use http\Exception\InvalidArgumentException;
use Riimu\EulerSolver\Problem\Problem1;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class SolverCommand extends Command
{
    /** @var class-string<EulerProblem>[]  */
    private const array PROBLEM_SOLVERS = [
        'Problem1' => Problem1::class,
    ];

    protected function configure(): void
    {
        $this
            ->setName('solve')
            ->setDescription('Solves the given problem')
            ->addArgument('problem', InputArgument::REQUIRED, 'The problem to solve');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new InvalidArgumentException('This command is only defined for console output');
        }

        $problemName = $input->getArgument('problem');

        if (!isset(self::PROBLEM_SOLVERS[$problemName])) {
            $output->getErrorOutput()->writeln(\sprintf('Invalid problem "%s"', $problemName));
            return Command::FAILURE;
        }

        $solverClass = self::PROBLEM_SOLVERS[$problemName];
        $solver = new $solverClass();

        $output->writeln($solver->solve());

        return Command::SUCCESS;
    }
}
