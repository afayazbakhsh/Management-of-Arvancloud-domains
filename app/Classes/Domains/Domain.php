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

    // Create domains
    public function createDomain($request){

        $data = ["domain" => $request->domain,"domain_type" => "full"];
        $response = $this->domainRequest('post','/dns-service',$data);
        return $this->checkResponse(201);
    }



    //Delete domain
    public function deleteDomain($domain){

        $domainData = $this->getByDomain($domain);

        if($domainData['data']['id']){

            $data = ["id" => $domainData['data']['id'],];
            $response = $this->domainRequest('delete',$domain,$data);
            return $this->checkResponse(201);
        }else{

            return response("Domain Not Found",404);
        }
    }

    // Update domains
    public function updateDomain($request,$domain){

        $data = ["ns_keys" => [$request->ns_keys[0],$request->ns_keys[1]]];

        $response = $this->domainRequest('put',$domain.'/ns-keys',$data);
        return $this->checkResponse(201);
    }
}
