<?php
    //Start session
    session_start();
    $api_key = $_COOKIE['apikey'];
    class preferencesAPI{
        private static $instance = null;
        public $conn;
        public static function getInstance(){
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        private function __construct(){
            $servername = "wheatley.cs.up.ac.za";
            $username = "u22561154";
            $password = "6SGC6BFVL4LPHW2ELWRMQMQMNOY6GADV";
            $db_name = "u22561154_";
            $this->conn = mysqli_connect($servername, $username, $password, $db_name); 
        }
        public function __destruct(){
            $this->conn->close();
        }
        public function updateUserPreferences($data){
                $api_key = $_COOKIE['apikey'];
                $sql = "INSERT INTO user_filter (APIkey, body_type, transmission_type, sort)
                        VALUES (?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE APIkey = VALUES(APIkey), body_type = VALUES(body_type), transmission_type = VALUES(transmission_type), sort = VALUES(sort)";
                  
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('ssss', $api_key,$data->preferences[0],$data->preferences[1],$data->preferences[2]);
                $stmt->execute();            
        }
        
        public function getUserPreferences(){
            $api_key = $_COOKIE['apikey'];
            $stmt = $this->conn->prepare('SELECT * FROM user_filter WHERE APIkey = ?');
            $stmt->bind_param('s', $api_key);
            $stmt->execute();
            $result = $stmt->get_result();
            $preferences = array();
            while($row = mysqli_fetch_assoc($result)){
                $preferences[] = $row;
            }
            return $preferences;
        }
        public function response($success, $message="",$data=""){
            if($success == "Failure"){
                header("HTTP/1.1 401 Bad Request");
                header("Content-Type: application/json");
            }else{
                header("HTTP/1.1 200 OK");
                header("Content-Type: application/json");
            }
            
            echo json_encode([
                "success" => $success,
                "timestamp" => time(),
                "message" => $message,
                "data" => $data
            ]);
        }
    }


    //Retreive user filter preferences
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $preferences = preferencesAPI::getInstance();
        try{
            $preferences->response("Success","Preferences retreived",$preferences->getUserPreferences());
        }catch(Exception $e){
            $preferences->response("Failure","Preferences not retreived");
        }
        
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $preferences = preferencesAPI::getInstance();
        try{
            $preferences->updateUserPreferences($data);
            $preferences->response("Success","Preferences Updated");
        }catch(Exception $e){
            $preferences->response("Failure","Preferences not updated");
        }
        
    }
?>