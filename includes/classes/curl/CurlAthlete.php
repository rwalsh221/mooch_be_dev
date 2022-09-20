<?php 
require_once("CurlSettings.php");

class CurlAthlete extends CurlSettings {

   private $athleteInfo = array();

    private function setAthleteInfo() {
        $stravaApiCall = $this->curlInit();
        $athleteJsonDecode = json_decode($stravaApiCall, true);
        $athleteJsonDecodeKeys = array_keys($athleteJsonDecode);

        foreach($athleteJsonDecodeKeys as $key) {
            if($key === 'firstname' 
            || $key === 'lastname' 
            || $key === 'profile_medium') {
                $this->athleteInfo[$key] = $athleteJsonDecode[$key];
            }
        };
        echo json_encode($this->athleteInfo, JSON_UNESCAPED_SLASHES);
    }

    public function getAthlete() {
        
        $this->setAthleteInfo();
    }
}
?>