<?php
namespace App\Classes;
use App\Classes\Request;

class Domain extends Request{

        // Get All Domains
    public function getAllDomains(){

        $response = $this->domainRequest('get','',[]);
        return $this->checkResponse(200);
    }
}
