<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LuisController extends Controller
{
    /** Client $client */
    private $client;

    public function __construct() {
        $this->client = new Client();
    }

    protected function luisRequest($query) {
        return $this->luisQuery($query);
    }

    private function luisQuery($query) {
        $qs = http_build_query( array (
                "q" => $query,
                "timezoneOffset" => 0,
                "verbose" => "false",
                "spellCheck" => "false",
                "staging" => "false"
            )
        );

        $url = env('LUIS_END_POINT') . env('LUIS_APP_ID') . "?" . $qs;

        $result = $this->client->request('GET', $url, ['headers' => [
                "Ocp-Apim-Subscription-Key" => env('LUIS_SUBSCRIPTION_KEY')
            ]
        ]);

        return $result->getBody()->getContents();
    }
}
