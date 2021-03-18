# POC FOR ELASTICSEARCH WITH PHP

This repo contains codes to test the elasticsearch integration with PHP

## Requirements

- Docker

## How to install

```bash
~ git clone 

~ docker-compose up -d

# done!
```

To see the elasticsearch working you need to get your private IP with the following command on linux:

```
~ip a
```
**Output:**
```
1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
    inet 127.0.0.1/8 scope host lo
       valid_lft forever preferred_lft forever
    inet6 ::1/128 scope host 
       valid_lft forever preferred_lft forever
2: enp1s0: <NO-CARRIER,BROADCAST,MULTICAST,UP> mtu 1500 qdisc fq_codel state DOWN group default qlen 1000
    link/ether 64:1c:67:94:a2:d0 brd ff:ff:ff:ff:ff:ff
3: wlp2s0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue state UP group default qlen 1000
    link/ether 64:32:a8:1d:10:73 brd ff:ff:ff:ff:ff:ff
    inet 192.168.1.6/24 brd 192.168.1.255 scope global dynamic noprefixroute wlp2s0
       valid_lft 66671sec preferred_lft 66671sec
    inet6 fe80::8bcf:30ce:dc16:d6c/64 scope link noprefixroute 
       valid_lft forever preferred_lft forever
4: mpqemubr0-dummy: <BROADCAST,NOARP> mtu 1500 qdisc noop master mpqemubr0 state DOWN group default qlen 1000
    link/ether 52:54:00:18:a8:be brd ff:ff:ff:ff:ff:ff
5: mpqemubr0: <NO-CARRIER,BROADCAST,MULTICAST,UP> mtu 1500 qdisc noqueue state DOWN group default qlen 1000

```
The IP address is here (192.168.1.6):

`inet 192.168.1.6/24 brd 192.168.1.255 scope global dynamic noprefixroute wlp2s0`

Then hit the browser on `http://192.168.1.6:9200`

You should see this json:

```
// 20210317210832
// http://192.168.1.6:9200/

{
  "name": "4e29c8bd92a0",
  "cluster_name": "docker-cluster",
  "cluster_uuid": "JbdmYMxZQXq19cLHyNQiMA",
  "version": {
    "number": "7.11.2",
    "build_flavor": "default",
    "build_type": "docker",
    "build_hash": "3e5a16cfec50876d20ea77b075070932c6464c7d",
    "build_date": "2021-03-06T05:54:38.141101Z",
    "build_snapshot": false,
    "lucene_version": "8.7.0",
    "minimum_wire_compatibility_version": "6.8.0",
    "minimum_index_compatibility_version": "6.0.0-beta1"
  },
  "tagline": "You Know, for Search"
}
```

**Elasticsearch conguration:**

In this repo the elasticsearch is running as `single-node`. The **user** and **password** is both `admin` 

**seed with neighborhood data**

In this project, there is a `seed.php` on `/app` folder. This script consume the `bairros_maceió.txt` file
to bulk insert data into elasticsearch. Just execute the following commands:

```bash
#get into app folder
~ cd app/

~ php seed.php
```

This command should work fine and the ellastic search will be populated.

**Search for results:**

This is the commands to fetch results from elasticsearch:

```bash
~ cd /examples

~ php search.php <neighborhood_name>

# e.g.: php search.php ponta
```

The output shold be like that:

```bash
^ array:4 [
  "took" => 2
  "timed_out" => false
  "_shards" => array:4 [
    "total" => 1
    "successful" => 1
    "skipped" => 0
    "failed" => 0
  ]
  "hits" => array:3 [
    "total" => array:2 [
      "value" => 3
      "relation" => "eq"
    ]
    "max_score" => 1.0
    "hits" => array:3 [
      0 => array:5 [
        "_index" => "neighborhoods"
        "_type" => "_doc"
        "_id" => "l2tcQngBzXt0-r7R5129"
        "_score" => 1.0
        "_source" => array:3 [
          "description" => "Ponta Verde\n"
          "city" => "Maceió"
          "state" => "AL"
        ]
      ]
      1 => array:5 [
        "_index" => "neighborhoods"
        "_type" => "_doc"
        "_id" => "mGtcQngBzXt0-r7R5129"
        "_score" => 1.0
        "_source" => array:3 [
          "description" => "Pontal da Barra\n"
          "city" => "Maceió"
          "state" => "AL"
        ]
      ]
      2 => array:5 [
        "_index" => "neighborhoods"
        "_type" => "_doc"
        "_id" => "mWtcQngBzXt0-r7R5129"
        "_score" => 1.0
        "_source" => array:3 [
          "description" => "Ponta Grossa\n"
          "city" => "Maceió"
          "state" => "AL"
        ]
      ]
    ]
  ]
]
```

If you wants to test other possibilities, just open the `app/bairros_maceió.txt` file and use 
some other name.

## Cerebro

To see the client, just go into `http://localhost:9000`

the credentials is:
```
host: <your_private_ip>:9200
user: admin
password: admin
```