<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ElasticCreateIndexCommand extends ContainerAwareCommand
{

    const INDEX_NAME = 'winegram';

    protected function configure()
    {
        $this
            ->setName('elastic:create:index')
            ->setDescription('Creates the "'.self::INDEX_NAME.'" Elasticsearch index')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $client = $container->get('elastic.client');

        $params = [
            'index' => self::INDEX_NAME,
            'body' => [
                'mappings' => [
                    'comment' => [
                        'properties' => [
                            'original_text' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'lang' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'text_sentiment' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'text_tweet_sentiment' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'type' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'username' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'media' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'query' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'search_type' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'search_content' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                        ]
                    ],
                    'wine' => [
                        'properties' => [
                            'name' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'rank' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'producer_description' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'maker_description' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'url' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'vintage' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'wine_type' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'bottle_volume' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'grapes' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'pairing' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'alcohol_volume' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'long_name' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ],
                            'image_full' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'image_maker_full' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'maker' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        if ($client->indices()->exists(['index' => self::INDEX_NAME])) {
            $response = $client->indices()->delete(['index' => self::INDEX_NAME]);
            $output->writeln("\nDelete index:");
            $output->writeln(var_dump($response));
        }

        $response = $client->indices()->create($params);
        $output->writeln("\nCreate index:");
        $output->writeln(var_dump($response));
    }

}
