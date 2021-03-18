<?php

require __DIR__ . '/../vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://elasticsearch:9200'])
    ->build();
$pattern = $argv[1];
$params = [
    'index' => 'neighborhoods',
    'body' => [
        'query' => [
            'wildcard' => [
                'description' => "*{$pattern}*"
            ]
        ]
    ]
];

$result = $client->search($params);
dd($result);
