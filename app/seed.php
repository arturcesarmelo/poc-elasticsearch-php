<?php

use Ramsey\Uuid\Uuid;

require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://elasticsearch:9200'])
    ->build();

$uuid = Uuid::uuid4()->toString();
$fp = fopen('./bairros_maceió.txt', 'r');

$params = ['body' => []];
while (!feof($fp)) {
    $params['body'][] = [
        'index' => [
            '_index' => 'neighborhoods'
        ]
    ];

    $params['body'][] = [
        'description' => fgets($fp),
        'city' => 'Maceió',
        'state' => 'AL'
    ];
}

$result = $client->bulk($params);
dd($result);
