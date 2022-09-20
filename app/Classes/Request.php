<?php
namespace App\Classes\Domains;

use Illuminate\Support\Facades\Http;


class Request{

    private function domainRequest($method,$path,$data){

        return  Http::acceptJson()->withHeaders([
            'Authorization' => env('ARVANCLOUD_API_KEY'),
        ])->$method('https://napi.arvancloud.com/cdn/4.0/domains/'.$path,$data);
    }
}
