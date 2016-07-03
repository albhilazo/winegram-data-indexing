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
                        '_timestamp' => [
                            'enabled' => 'true',
                        ],
                        'properties' => [
                            'original_text' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
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
                                'analyzer' => 'basic_analyzer'
                            ],
                            'username' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'media' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'query' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'search_type' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'search_content' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                        ]
                    ],
                    'wine' => [
                        'properties' => [
                            'name' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'rank' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'producer_description' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'category' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'maker_description' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'url' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'vintage' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'wine_type' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'bottle_volume' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'grapes' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'pairing' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
                            ],
                            'alcohol_volume' => [
                                'type' => 'string',
                                'index' => 'no'
                            ],
                            'long_name' => [
                                'type' => 'string',
                                'analyzer' => 'basic_analyzer'
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
                                'analyzer' => 'basic_analyzer'
                            ]
                        ]
                    ]
                ],

                'settings' => [
                    'analysis' => [

                        // Character filters are processed before the tokenizer
                        // Any pattern token or escaping must be backslashed twice
                        'char_filter' => [],

                        // Token filters modify tokens received from a tokenizer
                        'filter' => [
                            // English
                            'english_stop' => [
                                'type' => 'stop',
                                'stopwords' => '_english_'
                            ],
                            'english_stemmer' => [
                                'type' => 'stemmer',
                                'language' => 'english'
                            ],
                            'english_possessive_stemmer' => [
                                'type' => 'stemmer',
                                'language' => 'possessive_english'
                            ],

                            // Spanish
                            'spanish_stop' => [
                                "type"      => "stop",
                                "stopwords" => "_spanish_" 
                            ],
                            'spanish_stemmer' => [
                                "type"     => "stemmer",
                                "language" => "light_spanish"
                            ],

                            // Catalan
                            'catalan_elision' => [
                                "type"     => "elision",
                                '"articles"' => [ "d", "l", "m", "n", "s", "t" ]
                            ],
                            'catalan_stop' => [
                                "type"      => "stop",
                                "stopwords" => "_catalan_" 
                            ],
                            'catalan_stemmer' => [
                                "type"     => "stemmer",
                                "language" => "catalan"
                            ]
                        ],

                        // Analyzers are composed of a single tokenizer
                        //   and zero or more token filters and char filters
                        'analyzer' => [
                            // Filter order matters

                            'basic_analyzer' => [
                              "tokenizer"   => "standard",
                              "filter"      => ["lowercase", "asciifolding"],
                              "char_filter" => ["html_strip"],
                            ],
                            'basic_analyzer_en' => [
                              "tokenizer"   => "standard",
                              "filter"      => ["english_possessive_stemmer", "lowercase", "asciifolding", "english_stop", "english_stemmer"],
                              "char_filter" => ["html_strip"],
                            ],
                            'basic_analyzer_es' => [
                              "tokenizer"   => "standard",
                              "filter"      => ["lowercase", "asciifolding", "spanish_stop", "spanish_stemmer"],
                              "char_filter" => ["html_strip"],
                            ],
                            'basic_analyzer_ca' => [
                              "tokenizer"   => "standard",
                              "filter"      => ["catalan_elision", "lowercase", "asciifolding", "catalan_stop", "catalan_stemmer"],
                              "char_filter" => ["html_strip"],
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
