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
            return $this->checkResponse(200);
        }else{

            return response("Domain Not Found",404);
        }
    }

    // Update domains
    public function updateDomain($request,$domain){

        $data = ["ns_keys" => [$request->ns_keys[0],$request->ns_keys[1]]];

        $response = $this->domainRequest('put',$domain.'/ns-keys',$data);
        return $this->checkResponse(200);
    }

    //Reset custom Nameserver keys to the default values for the domain
    public function resetDomain($domain){

        $response = $this->domainRequest('delete',$domain.'/ns-keys',[]);
        return $this->checkResponse(200);
    }

    //check activity domains
    public function ActivityDomain($domain){

        $response = $this->domainRequest('get',$domain.'/ns-keys/check',[]);
        return $response['data'];
    }

    // Set a custom record for using CNAME Setup
    //this option need Enterprise plan
    public function cnameSetup($request, $domain){

        $data = ["address" => $request->address];
        $response = $this->domainRequest('put',$domain.'/cname-setup/custom',$data);
        return $this->checkResponse(200);
    }

    //Reset the custom record of CNAME Setup to the default value
    //this option need Enterprise plan
    public function resetCnameSetup($domain){

        $response = $this->domainRequest('delete',$domain.'/cname-setup/custom',[]);
        return $this->checkResponse(200);
    }

        // Convert domain setup to cname
    // Cname setup can be used with sub domain
    public function convertToCname($domain){

        $response = $this->domainRequest('post',$domain.'/cname-setup/convert',[]);
        return $this->checkResponse(200);
    }

    // Check Cname Setup to find whether domain is activated
    public function checkCnameForActivity($domain){

        $response = $this->domainRequest('get',$domain.'/cname-setup/check',[]);
        return $this->checkResponse(200);
    }

    // Clone a domain config from another one
    public function cloneConfig($domain,Request $request){

        $data = ["from"=>$request->from];

        $response = $this->domainRequest('post',$domain.'/clone',$data);
        return $response;
    }
}
