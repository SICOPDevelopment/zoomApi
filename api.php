<?php

 if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_GET['url'] == "hola-mundo"){
            $postData = $_POST['datos'];
            if(json_decode($postData) != null){
            $url = 'http://192.241.215.103:8888/';
            $url1 = 'http://192.241.215.103:8889/';
            $word1 =  callApi('GET',$url1)->res;
            $word2 = callApi('GET',$url)->res;
            $postData = json_decode($postData);
            $data = array("message" => $word1.' '.$word2,"parameters" => $postData);
            echo json_encode($data);
            }else{
                echo "Error: Only JSON Format is Allowed";
            }
        }
    }else{
         http_response_code(405);
    }


    function callApi($method, $url){         
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);    
        $result = json_decode(curl_exec($curl));    
        curl_close($curl);
        return $result;
    }
    function validaJson($data) {
        if (!empty($data)) {
                      @json_decode($data);
                      return (json_last_error() === JSON_ERROR_NONE);
              }
            return true;
      }
?>