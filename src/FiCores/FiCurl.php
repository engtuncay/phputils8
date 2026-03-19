<?php

namespace Engtuncay\Phputils8\FiCores;

use App\OnlineKraft\OkpCore\OkpLog;
use Engtuncay\Phputils8\FiDtos\Fdr;
use Engtuncay\Phputils8\FiDtos\FiKeybean;

/** 
 * This class has all the necessary code for making API calls thru curl library
 */
class FiCurl
{

  // This method will perform an action/method thru HTTP/API calls
  // Parameter description:
  // Method= POST, PUT, GET etc
  // Data= array("param" => "value") ==> index.php?param=value

  public static function request($method, $url, $data = false, ?FiKeybean $fkbHeaderParams): Fdr
  {
    $fdrMain = new Fdr();

    $fkbHeaderParams??=new FiKeybean();
    
    $curl = curl_init();

    switch ($method) {
      case "POST":
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($data) {
          curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        }
        break;
      case "PUT":
        curl_setopt($curl, CURLOPT_PUT, 1);
        break;
      default:
        if ($data)
          $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    if (isset($fkbHeaderParams)) {
      curl_setopt($curl, CURLOPT_HTTPHEADER, $fkbHeaderParams->getArr());
    }else{
      $fkbHeaderParams->add("Content-Type", "application/json; charset=utf-8");
      curl_setopt($curl, CURLOPT_HTTPHEADER, $fkbHeaderParams->getArr());
    }

    //array(
    // 'Content-Type: application/xml',
    // 'Connection: Keep-Alive'
    // )
    
  try {
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($curl);
      OkpLog::debug("FiCurl-Result", $result);
      $response = json_decode($result, true);
      $fdrMain->setFkbValue(new FiKeybean($response));

    } catch (\Exception $e) {
      // Handle exception if needed
      $fdrMain->setBoResult(true);
      $fdrMain->setTxMessage("Curl error: " . $e->getMessage());
      
    }
    
    curl_close($curl);
    return $fdrMain;
    
  }

  public static function request2($method, $url, $data = false, $headerParams)
  {

    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => 'UTF-8',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE),
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json; charset=utf-8'
      ],
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    //$this->logRequest($this->getIskProListApiUrl, $data, $response);

    $response = json_decode($response, true);
    return [
      'data' => $response,  //?  $response["fsRefFdr"]["refValue"] : [],
    ];
  }
}

// require_once("FiCurl.php");
// ...
// $action = "GET";
// $url = "api.server.com/model"
// echo "Trying to reach ...";
// echo $url;
// $parameters = array("param" => "value");
// $result = CurlHelper::perform_http_request($action, $url, $parameters);
// echo print_r($result)