<?php 
require_once("CurlSettings.php");

class CurlAthleteNewAuthToken extends CurlSettings {

   public function getAuthToken() {
        $stravaApiCallJson = $this->curlInit();
        
        $stravaApiCallDecode = json_decode($stravaApiCallJson, true);
        // $stravaApiCallDecodeKeys = array_keys($stravaApiCallDecode);
        echo $stravaApiCallDecode;
        return $stravaApiCallDecode;
        // foreach($stravaApiCallDecodeKeys as $key) {
        //     if (gettype($stravaApiCallDecode[$key]) === 'array' && !str_starts_with($key, 'recent')) {
        //         $this->setAthleteStats($key, $stravaApiCallDecode);
        //     };
        // }
    }

}
?>