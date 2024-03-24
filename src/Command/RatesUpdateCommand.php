<?php

namespace App\Command;

use App\Service\RatesUpdater;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:update-rates')]
class RatesUpdateCommand extends Command
{
    public function __construct(
        private RatesUpdater $ratesUpdater
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rates = $this->ratesUpdater->update();
        if (isset($rates)) {
            $output->writeln('Rates succesfully updated!');
            return Command::SUCCESS;
        }
        return Command::FAILURE;
    }
}
