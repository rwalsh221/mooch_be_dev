<?php 
require_once("CurlSettings.php");

class CurlAthleteStats extends CurlSettings {
    private $athleteStats = array();
    
    private function setAthleteStats($key, $athleteStatsArray) {
        $this->athleteStats[$key] = $athleteStatsArray[$key]['distance'];
    }

    private function curlAthleteStats() {
        $stravaApiCallJson = $this->curlInit();
        $athleteStatsJsonDecode = json_decode($stravaApiCallJson, true);
        $athleteStatsJsonDecodeKeys = array_keys($athleteStatsJsonDecode);

        foreach($athleteStatsJsonDecodeKeys as $key) {
            if (gettype($athleteStatsJsonDecode[$key]) === 'array' && !str_starts_with($key, 'recent')) {
                $this->setAthleteStats($key, $athleteStatsJsonDecode);
            };
        }
    }

    public function getAthleteStats() {
        $this->curlAthleteStats();
        echo json_encode($this->athleteStats);
   }
}
?>