<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use PhpParser\Node\Stmt\TryCatch;

class Pages extends BaseController
{
    public function fetchData()
    {

        $option = [];
        $area = $this->request->getPost('area');
        if($area != []){
            $area = join(',',$area);
            $area = str_replace(" ","%20",$area);
        }

        $arr_option=[];
        $option_area=[];
        $option_brand=[];
    
        $early_date = $this->request->getPost('early_date');
        $last_date = $this->request->getPost('last_date');

        //url untuk diagram
        $url = "http://localhost:7680/data?area=".$area ."&early_date=".$early_date ."&last_date=".$last_date;

        //url untuk table         
        $url_brand = "http://localhost:7680/data/brand?area=".$area ."&early_date=".$early_date ."&last_date=".$last_date;

        // Gunakan HTTP Client untuk melakukan GET request
        $client = \Config\Services::curlrequest($arr_option);

        $response = json_decode($client->get($url)->getBody())->data;
        $response_brand = json_decode($client->get($url_brand)->getBody())->data;
        

        foreach ($response as $value) {
        $temp = $value->Nilai;
        array_push($option, $temp);
        }

        foreach ($response as $value) {
            $temp = $value->area_name;
            array_push($option_area, $temp);
        }

        foreach($response_brand as $name_brand){
            if(!in_array($name_brand->brand_name, $option_brand)){
                array_push($option_brand, $name_brand->brand_name);
            }
        }
        
        $data = ["area"=>$area, "data"=>$response, "data_brand"=>$response_brand, "brand_name"=>$option_brand, "nilai"=>$option, "label"=>$option_area];
        return view('index', $data);


    }

    


}