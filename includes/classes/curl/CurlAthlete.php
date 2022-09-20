<?php 
require_once("CurlSettings.php");

class CurlAthlete extends CurlSettings {

   private $athleteInfo = array();

    private function setAthleteInfo() {
        $stravaApiCall = $this->curlInit();
        $athleteJson = json_decode($stravaApiCall, true);
        $athleteJsonKeys = array_keys($athleteJson);

        foreach($athleteJsonKeys as $key) {
            if($key === 'firstname' 
            || $key === 'lastname' 
            || $key === 'profile_medium') {
                $this->athleteInfo[$key] = $athleteJson[$key];
            }
        };
        echo json_encode($this->athleteInfo, JSON_UNESCAPED_SLASHES);
    }

    public function getAthlete() {
        
        $this->setAthleteInfo();
    }
}
?>