<?php
namespace App\Classes;
use App\Classes\Request;

class Domain extends Request{

        // Get All Domains
    public function getAllDomains(){

        $response = $this->domainRequest('get','',[]);
        return $this->checkResponse(200);
    }

    //get domain data by domain address
    public function getByDomain($domain){

        $response = $this->domainRequest('get',$domain.'',[]);
        return $this->checkResponse(200);
    }
}
