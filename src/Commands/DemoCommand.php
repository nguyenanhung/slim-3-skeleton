<?php
/**
 * Project slim-3-skeleton.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/23/18
 * Time: 22:27
 */

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DemoCommand
 *
 * @package Command
 */
class DemoCommand extends Command
{
    /**
     * Function configure
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/23/18 22:28
     *
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:demo-command')
            // the short description shown while running "php bin/console list"
            ->setDescription("Hello World!")
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Hello World!');
    }

    /**
     * Function execute
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/23/18 22:28
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @command php cli.php app:demo-command
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Example code
        $output->writeLn("Hello World!");
    }
}
