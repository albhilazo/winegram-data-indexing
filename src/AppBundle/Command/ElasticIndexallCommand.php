<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ElasticIndexallCommand extends ContainerAwareCommand
{

    const INDEX_NAME = 'winegram';

    protected function configure()
    {
        $this
            ->setName('elastic:indexall')
            ->setDescription('Indexes all items of the specified type in Elasticsearch')
            ->addArgument('type', InputArgument::REQUIRED, 'Type to index')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $type = $input->getArgument('type');

        $container->get('index_all')->execute($type);
    }

}

