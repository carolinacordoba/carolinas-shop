<?php


require_once("vendor/autoload.php"); // LADDA ALLA DEPENDENCIES FROM VENDOR
require_once("Models/Product.php"); // LADDA ALLA DEPENDENCIES FROM VENDOR

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

require_once("Models/Database.php"); // LADDA ALLA DEPENDENCIES FROM VENDOR
//  :: en STATIC funktion
$dotenv = Dotenv\Dotenv::createImmutable("."); // . is  current folder for the PAGE
$dotenv->load();


class SearchEngine
{
    // Nr 12
    // Sätt dessa som variabelnamn istället utifrån .env filen

    private $accessKey;
    private $secretKey;
    private $url;
    private $index_name;

    private $client;

    function __construct()
    {
        $this->accessKey = $_ENV["ACCESS_KEY"];
        $this->secretKey = $_ENV["SECRET_KEY"];
        $this->url = $_ENV["URL"];
        $this->index_name = $_ENV["INDEX_NAME"];

        $this->client = new Client([
            'base_uri' => $this->url,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->accessKey . ':' . $this->secretKey),
                'Content-Type' => 'application/json'
            ]
        ]);

    }

    function getDocumentIdOrUndefined(string $webId): ?string
    {
        $query = [
            'query' => [
                'term' => [
                    'webid' => $webId
                ]
            ]
        ];


        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            return $data['hits']['hits'][0]['_id'];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }

    // Integration med tredjepartssystem: REST/JSON, Filer (XML mot Prisjakt) - språk/regelverk att förhålla sig till

    function search(string $query, string $sortCol, string $sortOrder)
    {
        $q = $query . '*';
        $query = [
            'query' => [
                'query_string' => [
                    'query' => $q,
                ]
            ],
            'sort' => [
                $sortCol => [
                    'order' => $sortOrder
                ]
            ],
            'aggs' => [
                'facets' => [
                    'nested' => [
                        'path' => 'string_facet',

                    ],
                    'aggs' => [
                        'names' => [
                            'terms' => [
                                'field' => 'string_facet.facet_name',
                                'size' => 10
                            ],
                            'aggs' => [
                                'values' => [
                                    'terms' => [
                                        'field' => 'string_facet.facet_value',
                                        'size' => 10
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];

        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            // data.hits.total.value
            if (empty($data['hits']['total']['value'])) {
                return null;
            }
            //print_r($data["aggregations"]["facets"]['names']['buckets'] );

            $data["hits"]["hits"] = $this->convertSearchEngineArrayToProduct($data["hits"]["hits"]);

            return $data["hits"]["hits"];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }


    /*
    array(4) { ["_index"]=> string(11) "products-12" ["_id"]=> string(20) "JevW55YBjv4AvNg2A_3B" ["_score"]=> float(1) ["_source"]=> array(9) { ["webid"]=> int(24) ["title"]=> string(18) "Sleek Cotton Clock" ["description"]=> string(127) "Fabric-covered clock with silent quartz movement. Minimalist design blends into any decor. Hidden stitching ensures durability." ["price"]=> int(10) ["categoryName"]=> int(5) ["stockLevel"]=> int(98) ["color"]=> string(5) "white" ["categoryid"]=> int(5) ["string_facet"]=> array(2) { [0]=> array(2) { ["facet_name"]=> string(5) "Color" ["facet_value"]=> string(5) "white" } [1]=> array(1) { ["facet_name"]=> string(8) "Category" } } } }
    
    */

    function convertSearchEngineArrayToProduct($searchengineResults)
    {
        $newarray = [];
        foreach ($searchengineResults as $hit) {
            // echo "MUUU";
            // var_dump($hit);
            $prod = new Product();
            $prod->id = $hit["_source"]["webid"];
            $prod->title = $hit["_source"]["title"];
            $prod->shortDescription = $hit["_source"]["shortDescription"];
            $prod->longDescription = $hit["_source"]["longDescription"];
            $prod->price = $hit["_source"]["price"];
            $prod->categoryName = $hit["_source"]["categoryName"];
            $prod->stockLevel = $hit["_source"]["stockLevel"];
            $prod->imageUrl = $hit["_source"]["imageUrl"];
            $prod->popularityFactor = $hit["_source"]["popularityFactor"];

            array_push($newarray, $prod);
        }
        return $newarray;

    }



    // $res = search("cov*",$accessKey,$secretKey,$url,$index_name);
// //var_dump(count($res["hits"]["hits"]));
// for($i =0 ; $i < count($res["hits"]["hits"]); $i++){
//     $hit = $res["hits"]["hits"][$i];
// //    var_dump($hit);
//     echo $hit["_id"] . ","; 
//     echo $hit["_source"]["webid"] . ","; 
//     echo $hit["_source"]["title"] . ","; 
//     echo $hit["_source"]["price"] . "</br>"; 
// }



}





// $res = getDocumentIdOrUndefined(1,$accessKey,$secretKey,$url,$index_name);
// if ($res == null){
//     die("INGET");
// }else{
// }