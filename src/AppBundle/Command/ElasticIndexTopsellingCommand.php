<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ElasticIndexTopsellingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elastic:index:topselling')
            ->setDescription('Indexes the top selling products in Elasticsearch')
            ->addArgument('wine_category', InputArgument::OPTIONAL, 'Defaults to "tinto"')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $wineCategory = $input->getArgument('wine_category');

        $wineCategory = ($wineCategory) ? $wineCategory : 'tinto';

        $container->get('index_topselling')->execute($wineCategory);
    }

}
