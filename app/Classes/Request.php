<?php
namespace App\Classes;

use Illuminate\Support\Facades\Http;


class Request{

    public function domainRequest($method,$path,$data){

        return  Http::acceptJson()->withHeaders([
            'Authorization' => env('ARVANCLOUD_API_KEY'),
        ])->$method('https://napi.arvancloud.com/cdn/4.0/domains/'.$path,$data);
    }

    public function checkResponse($code){

        return $response ? $response->status() == $code : $response;
    }


}
