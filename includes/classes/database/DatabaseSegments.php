<?php 
require_once('DatabaseSettings.php');

class DatabaseSegments extends DatabaseSettings {
    public function getSegmentIds() {
        $sql = 'SELECT segmentId FROM segments';

        return $this->getFromDatabase($sql);

    }

    public function updateUserSegementTime($segmentId, $userId, $segmentTime) {
        $sql = "SELECT segmentTime from segmentTimes WHERE segmentId='$segmentId' AND userId='$userId'";

        $result = $this->getFromDatabase($sql);
        var_dump($result[0]['segmentTime']);
    
        if(empty($result)) {
            // INSERT INTO
            $sql = "INSERT INTO segmentTimes (userId, segmentId, segmentTime)
            VALUES ('$userId', '$segmentId', '$segmentTime')";

            $this->insertIntoDatabase($sql);

        } else if ($segmentTime > $result[0]['segmentTime']) {
            // UPDATE
            echo 'else';
            $sql = "UPDATE segmentTimes SET segmentTime='$segmentTime' WHERE segmentId='$segmentId' AND userId='$userId'";

            $this->insertIntoDatabase($sql);
        }
    }

    public function getUserSegments($userId) {
        $sql = "SELECT segmentId from segmentTimes WHERE userId='$userId'";

        $result = $this->getFromDatabase($sql);
       
        $userSegments = array();

        foreach($result as $segmentId) {
            
            $segmentId=$segmentId['segmentId'];

            $sql = "SELECT * from segments WHERE segmentId='$segmentId'";

            $result = $this->getFromDatabase($sql);

            array_push($userSegments, $result);
        }

        return $userSegments;
    }

}
?>