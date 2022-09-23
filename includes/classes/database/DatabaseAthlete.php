<?php 
require_once('DatabaseSettings.php');

class DatabaseAthlete extends DatabaseSettings {

    public function getAthlete() {

    }

    public function setAthlete() {

    }

    public function getAthleteStats() {
        // $sql = "SELECT rideYearDist, rideAllTimeDist, runYearDist, runAlltimeDist, swimYearDist, swimAllTimeDist FROM Athlete WHERE id=1";
        $sql = "SELECT * FROM athlete WHERE id='1'";
        $this->getFromDatabase($sql);
    }

    public function setAthleteStats() {

    }
}
?>