<?php

declare(strict_types=1);

namespace Riimu\EulerSolver;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class SolverCommand extends Command
{
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
            throw new \InvalidArgumentException('This command is only defined for console output');
        }

        $problemName = $input->getArgument('problem');
        $problemSolvers = $this->getProblemSolvers();

        if (!isset($problemSolvers[$problemName])) {
            $output->getErrorOutput()->writeln(\sprintf('Invalid problem "%s"', $problemName));
            return Command::FAILURE;
        }

        $solverClass = $problemSolvers[$problemName];
        $solver = new $solverClass();

        $timer = new RunTimer();
        $solution = $solver->solve();
        $milliseconds = $timer->getMilliseconds();

        $output->writeln(\sprintf('Solution for the solver "%s" solved in %d ms', $problemName, $milliseconds));
        $output->writeln($solution);

        return Command::SUCCESS;
    }

    /**
     * @return array<string, class-string<EulerProblem>>
     */
    private function getProblemSolvers(): array
    {
        $problems = [];
        $finder = new Finder()->files()->in(__DIR__ . '/Problem')->name('Problem*.php');

        foreach ($finder as $file) {
            $name = $file->getBasename('.php');
            $class = 'Riimu\\EulerSolver\\Problem\\' . $name;

            if (class_exists($class)) {
                $problems[$name] = $class;
            }
        }

        return $problems;
    }
}
