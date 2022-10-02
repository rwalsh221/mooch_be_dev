<?php 
require_once('DatabaseSettings.php');

class DatabaseAthlete extends DatabaseSettings {

    public function getAthlete($userId) {
        $sql = "SELECT firstName, lastName, profileImgUrl
         FROM athlete WHERE id=$userId";
        $dbResult = $this->getFromDatabase($sql);
        return $dbResult;
}

    public function registerAthlete($userId, $firstName, $lastName, $profileImgUrl, 
    $tokenExpiresAt, $tokenExpiresIn, $accessToken, $refreshToken) {
        $sql = "INSERT INTO athlete (userId, firstName, lastName, unitPreference, profileImgUrl, tokenExpiresAt, tokenExpiresIn, accessToken, refreshToken)
        VALUES ('$userId', '$firstName', '$lastName', 'kilometre', '$profileImgUrl', '$tokenExpiresAt', '$tokenExpiresIn', '$accessToken', '$refreshToken')";

        // $sql = "INSERT athlete (userId)
        // VALUES ($userId)";

        $this->insertIntoDatabase($sql);
    }

    public function getAthleteStats($userId) {
        $sql = "SELECT rideAllTimeDist, rideYearDist, runAllTimeDist, runYearDist, swimAllTimeDist, swimYearDist
         FROM athleteStats WHERE userId=$userId";
        $dbResult = $this->getFromDatabase($sql);
        return $dbResult;
    }

    public function insertAthleteStats($userId, $athleteStats) {
        // PHP ASSOC ARRAY DESTRUCTURING
        ['all_ride_totals'=>$all_ride_totals, 'ytd_ride_totals'=>$ytd_ride_totals,
        'all_run_totals'=>$all_run_totals, 'ytd_run_totals'=>$ytd_run_totals,
        'all_swim_totals'=>$all_swim_totals, 'ytd_swim_totals'=>$ytd_swim_totals] = $athleteStats;
        // CAN BE CHNAGED WHEN SIGN UP IS ADDED AS athleteStats WILL BE SET ON SIGN UP
        $userRowIsSet = $this->getAthleteStats($userId);
        
        if($userRowIsSet) {
            $sql = "UPDATE athleteStats SET rideAllTimeDist = $all_ride_totals, rideYearDist = $ytd_ride_totals,
             runAllTimeDist = $all_run_totals, runYearDist = $ytd_run_totals, 
             swimAllTimeDist = $all_swim_totals, swimYearDist = $ytd_swim_totals WHERE userId=$userId";
        } else {
            $sql = "INSERT INTO athleteStats (userId, rideAllTimeDist, rideYearDist, runAllTimeDist, runYearDist, swimAllTimeDist, swimYearDist)
            VALUES ($userId, $all_ride_totals, $ytd_ride_totals, $all_run_totals, $ytd_run_totals, $all_swim_totals, $ytd_swim_totals)";

        }
        $this->insertIntoDatabase($sql);
    }
}
?>