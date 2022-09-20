<?php 
require_once("CurlSettings.php");

class CurlAthleteStats extends CurlSettings {

   public function getAthleteStats() {
    echo $this->curlInit();
   }
}
?>