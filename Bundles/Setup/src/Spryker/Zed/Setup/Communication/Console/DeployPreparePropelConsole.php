<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Setup\Communication\Console;

use Spryker\Zed\Console\Business\Model\Console;
use Spryker\Zed\Propel\Communication\Console\BuildModelConsole;
use Spryker\Zed\Propel\Communication\Console\ConvertConfigConsole;
use Spryker\Zed\Propel\Communication\Console\SchemaCopyConsole;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeployPreparePropelConsole extends Console
{

    const COMMAND_NAME = 'setup:deploy:prepare_propel';
    const DESCRIPTION = 'Prepares propel configuration on appserver';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->runDependingCommand(ConvertConfigConsole::COMMAND_NAME);
        $this->runDependingCommand(SchemaCopyConsole::COMMAND_NAME);
        $this->runDependingCommand(BuildModelConsole::COMMAND_NAME);
    }

    /**
     * @param string $command
     * @param array $arguments
     *
     * @return void
     */
    protected function runDependingCommand($command, array $arguments = [])
    {
        $command = $this->getApplication()->find($command);
        $arguments['command'] = $command;
        $input = new ArrayInput($arguments);
        $command->run($input, $this->output);
    }

}