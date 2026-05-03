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

        if (!\is_string($problemName)) {
            throw new \RuntimeException('Unexpected type for problem name');
        }

        $problemSolvers = $this->getProblemSolvers();

        if (!isset($problemSolvers[$problemName])) {
            $output->getErrorOutput()->writeln(\sprintf('Invalid problem "%s"', $problemName));
            return Command::FAILURE;
        }

        $solverClass = $problemSolvers[$problemName];
        $solver = new $solverClass();

        $timer = new RunTimer();
        memory_reset_peak_usage();
        $initial = memory_get_peak_usage();
        $solution = $solver->solve();
        $memory = $this->formatMemoryString(memory_get_peak_usage() - $initial);
        $milliseconds = $timer->getMilliseconds();

        $output->writeln(\sprintf(
            'Solution for the solver "%s" solved in %d ms (%s memory)',
            $problemName,
            $milliseconds,
            $memory,
        ));
        $output->writeln($solution);

        return Command::SUCCESS;
    }

    private function formatMemoryString(int $bytes): string
    {
        if ($bytes < 1000) {
            return "$bytes B";
        }

        $suffixes = ['B', 'KiB', 'MiB', 'GiB', 'TiB'];
        $log = (int) log($bytes, 1024);
        return number_format($bytes / 1024 ** $log, 2) . ' ' . $suffixes[$log];
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

            if (is_a($class, EulerProblem::class, true)) {
                $problems[$name] = $class;
            }
        }

        return $problems;
    }
}
