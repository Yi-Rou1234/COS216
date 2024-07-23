<?php
   class Database{
        private static $database;
        private $connection;

        private function __construct(){
            $this->connection = mysqli_connect('wheatley.cs.up.ac.za', 'u04954336', 'BPXVZ6LGXLZVFOTUN76XX6B2RQOD6QLL', 'u04954336_carsdb');
        }

        function __destruct(){
            $this->connection->close();
        }

        public static function getInstance(){
            if(self::$database == null){
                self::$database = new Database();
            }
            return self::$database;
        }

        public function getConnection(){
            return $this->connection;
        }
    }

    class validateAPI{
        private $json_request;
        private $dbconnection;
        private $validReturnArr;
        private $starArr;

        public function __construct($json_data){
            $this->json_request = $json_data;
            $this->dbconnection = Database::getInstance()->getConnection();
            $this->validReturnArr =  ['id_trim', 'make', 'model', 'generation', 'year_from', 'year_to', 'series', 'trim', 'body_type',
                                    'number_of_seats','length_mm', 'width_mm', 'height_mm', 'number_of_cylinders', 'engine_type', 'drive_wheels',
                                    'transmission', 'max_speed_km_per_h', 'image'];
            $this->starArr = ['id_trim', 'make', 'model', 'generation', 'year_from', 'year_to', 'series', 'trim', 'body_type',
            'number_of_seats','length_mm', 'width_mm', 'height_mm', 'number_of_cylinders', 'engine_type', 'drive_wheels',
            'transmission', 'max_speed_km_per_h'];
            
        }

        public function validateConnection(){
            if($this->dbconnection->connect_error){
                return false;
            }
            else{
                return true;
            }
        }

        public function validateJSON(){
            if(isset($this->json_request->apikey) && !empty($this->json_request->apikey) && isset($this->json_request->type) && !empty($this->json_request->type) && isset($this->json_request->return) && !empty($this->json_request->return)){
                return true;
            }
            else{
                return false;
            }
        }

        public function checkAPI(){
            if($this->json_request->apikey === '~9H/08%fT@we,)UKRbd4txjN%t!,Qi'){
                return true;
            }
            else{
                return false;
            }
        }

        public function checkReturn(){
            if(array_intersect($this->json_request->return, $this->validReturnArr) == $this->json_request->return){
                return true;
            }
            else{
                return false;
            }
        }
        
        public function checkDataType($input){
            if($input === 'id_trim' || $input === 'year_from' || $input === 'year_to' || $input === 'number_of_seats' ||
            $input === 'length_mm' || $input === 'width_mm' || $input === 'height_mm' || $input === 'number_of_cylinders' || 
            $input === 'max_speed_km_per_h'){
                return 'int';
            }
            else{
                return 'string';
            }
        }

        public function getSearchQuery($input){
            $query = ' WHERE ';
            $paramstr = '';
            $typestr = '';
            $first = true;
            if(isset($input->make)){
                $query .= 'make = ? ';
                $paramstr .= $input->make;
                $typestr .= 's';
                $first = false;
            }
            if(isset($input->model)){
                if(!$first){
                    $query .= 'AND model = ? ';
                    $paramstr .= ', ' . $input->model;
                    $typestr .= 's';
                }
                else{
                    $query .= 'model = ? ';
                    $paramstr .= $input->model;
                    $typestr .= 's';
                    $first = false;
                }
            }
            if(isset($input->body_type)){
                if(!$first){
                    $query .= 'AND body_type = ? ';
                    $paramstr .= ', ' . $input->body_type;
                    $typestr .= 's';
                }
                else{
                    $query .= 'body_type = ? ';
                    $paramstr .= $input->body_type;
                    $typestr .= 's';
                    $first = false;
                }
            }
            if(isset($input->engine_type)){
                if(!$first){
                    $query .= 'AND engine_type = ? ';
                    $paramstr .= ', ' . $input->engine_type;
                    $typestr .= 's';
                }
                else{
                    $query .= 'engine_type = ? ';
                    $paramstr .= $input->engine_type;
                    $typestr .= 's';
                    $first = false;
                }
            }
            if(isset($input->transmission)){
                if(!$first){
                    $query .= 'AND transmission = ? ';
                    $paramstr .= ', ' . $input->transmission;
                    $typestr .= 's';
                }
                else{
                    $query .= 'transmission = ? ';
                    $paramstr .= $input->transmission;
                    $typestr .= 's';
                    $first = false;
                }
            }
            return array($query, $paramstr, $typestr);
        }

        public function getFuzzySearchQuery($input){
            $query = ' WHERE ';
            $paramstr = '';
            $typestr = '';
            $first = true;
            if(isset($input->make)){
                $query .= 'make LIKE ? ';
                $paramstr .= '%' . $input->make . '%';
                $typestr .= 's';
                $first = false;
            }
            if(isset($input->model)){
                if(!$first){
                    $query .= 'AND model LIKE ? ';
                    $paramstr .= ', %' . $input->model . '%';
                    $typestr .= 's';
                }
                else{
                    $query .= 'model LIKE ? ';
                    $paramstr .= '%' . $input->model . '%';
                    $typestr .= 's';
                    $first = false;
                }
            }
            if(isset($input->body_type)){
                if(!$first){
                    $query .= 'AND body_type LIKE ? ';
                    $paramstr .= ', %' . $input->body_type . '%';
                    $typestr .= 's';
                }
                else{
                    $query .= 'body_type LIKE ? ';
                    $paramstr .= '%' . $input->body_type . '%';
                    $typestr .= 's';
                    $first = false;
                }
            }
            if(isset($input->engine_type)){
                if(!$first){
                    $query .= 'AND engine_type LIKE ? ';
                    $paramstr .= ', %' . $input->engine_type . '%';
                    $typestr .= 's';
                }
                else{
                    $query .= 'engine_type LIKE ? ';
                    $paramstr .= '%' . $input->engine_type . '%';
                    $typestr .= 's';
                    $first = false;
                }
            }
            if(isset($input->transmission)){
                if(!$first){
                    $query .= 'AND transmission LIKE ? ';
                    $paramstr .= ', %' . $input->transmission . '%';
                    $typestr .= 's';
                }
                else{
                    $query .= 'transmission LIKE ? ';
                    $paramstr .= '%' . $input->transmission .'%';
                    $typestr .= 's';
                    $first = false;
                }
            }
            return array($query, $paramstr, $typestr);
        }

        public function getStarArr(){
            return $this->starArr;
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = file_get_contents('php://input');
        $jdata = json_decode($data);
        $apireq = new validateAPI($jdata);

        if(!$apireq->validateConnection()){
            $response = array('status' => 'error', 'timestamp' => time(), 'data' => 'Error. Failed to make database connection.');
            http_response_code(502);
            echo json_encode($response);
            exit();
        }

        if(!$apireq->validateJSON()){
            $response = array('status' => 'error', 'timestamp' => time(), 'data' => 'Error. Post Parameters are missing or invalid.');
            http_response_code(400);
            echo json_encode($response);
            exit();
        }

        if(!$apireq->checkAPI()){
            $response = array('status' => 'error', 'timestamp' => time(), 'data' => 'Error. API Key is not valid.');
            http_response_code(400);
            echo json_encode($response);
            exit();
        }

        if($jdata->type != "GetAllCars"){
            $response = array('status' => 'error', 'timestamp' => time(), 'data' => 'Error. Bad Request, specified type is invalid.');
            http_response_code(400);
            echo json_encode($response);
            exit();
        }

        $searchBind = false;
        $searchStr = '';
        $paramStr = '';
        $typeStr = '';
        $realSearchStr = '';
        $starSelect = false;
        $returnArr = $jdata->return;
        $imgReturn = false;
        $query = 'SELECT ';
        if ($returnArr === '*'){
            $starSelect = true;
            $imgReturn = true;
        }
        if(!$starSelect){
            if(!$apireq->checkReturn()){
                $response = array('status' => 'error', 'timestamp' => time(), 'data' => 'Error. Return parameters are invalid.');
                echo json_encode($response);
                exit();
            }
            $searchStr = 'make, model, ';
            $countParams = count($returnArr);
            for($i = 0; $i < $countParams - 1; $i++){
                if($returnArr[$i] === 'image'){
                    $imgReturn = true;
                }
                else{
                    if(!($returnArr[$i] === 'make') && !($returnArr[$i] === 'model')){
                        $searchStr .= $returnArr[$i] . ', ';
                    }                    
                    $realSearchStr .= $returnArr[$i] . ', ';
                }
            }
            if($returnArr[$countParams - 1] === 'image'){
                $imgReturn = true;
                $searchStr = rtrim($searchStr, ', ');
                $realSearchStr = rtrim($realSearchStr, ', ');
            }
            else{
                if(!($returnArr[$countParams - 1] === 'make') && !($returnArr[$countParams - 1] === 'model')){
                    $searchStr .= $returnArr[$countParams - 1];
                }
                else{
                    $searchStr = rtrim($searchStr, ', ');
                }                
                $realSearchStr .= $returnArr[$countParams - 1];
            }

            $query .= $searchStr;

            $query .= ' FROM cars';
        }
        else{
            $query .= '*';
            $query .= ' FROM cars';
        }
        if(isset($jdata->search)){
            if(isset($jdata->fuzzy)){
                if($jdata->fuzzy == false){
                    $searchArr = $apireq->getSearchQuery($jdata->search);
                    if(!empty($searchArr[1])){
                        $query .= $searchArr[0];
                        $paramStr .= $searchArr[1];
                        $typeStr .= $searchArr[2];
                        $searchBind = true;
                    }
                }
                else{
                    $searchArr = $apireq->getFuzzySearchQuery($jdata->search);
                    if(!empty($searchArr[1])){
                        $query .= $searchArr[0];
                        $paramStr .= $searchArr[1];
                        $typeStr .= $searchArr[2];
                        $searchBind = true;
                    }
                }
            }
            else{
                $searchArr = $apireq->getFuzzySearchQuery($jdata->search);
                if(!empty($searchArr[1])){
                    $query .= $searchArr[0];
                    $paramStr .= $searchArr[1];
                    $typeStr .= $searchArr[2];
                    $searchBind = true;
                }
            }
            
        }
        if(isset($jdata->sort)){
            $query .= ' ORDER BY ' . $jdata->sort;
            if(isset($jdata->order)){
                $query .= ' ' . $jdata->order;
            }
            else{
                $query .= ' DESC';
            }
        }
        if(isset($jdata->limit)){
            if($jdata->limit > 500){
                $query .= ' LIMIT 500';
            }
            else{
                $query .= ' LIMIT ' . $jdata->limit;
            }
        }
        else{
            $query .= ' LIMIT 20';
        }

        
        $fieldsArr = explode(', ', $realSearchStr);
        if($searchBind){
            $paramArr = explode(', ', $paramStr);
            $execution = Database::getInstance()->getConnection()->prepare($query);        
            $execution->bind_param($typeStr, ...$paramArr);
            $execution->execute();
            $result = $execution->get_result();
        }
        else{
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
        }
        $data = array();        

        if($result){
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                if(!$starSelect){
                    for($j = 0; $j < count($fieldsArr); $j++){
                        $data[$i][$fieldsArr[$j]] = $row[$fieldsArr[$j]];
                    }
                    if($imgReturn){
                        $make = urlencode($row['make']);
                        $model = urlencode($row['model']);
                        $url = 	'https://wheatley.cs.up.ac.za/api/getimage?brand='.$make.'&model='.$model;
                        $link = curl_init();
                        curl_setopt($link, CURLOPT_URL, $url);
                        curl_setopt($link, CURLOPT_RETURNTRANSFER, 1);
                        $imgLink = curl_exec($link);
                        curl_close($link);
                        $data[$i]['image'] = $imgLink;
                    }
                }
                else{
                    $starArr = $apireq->getStarArr();
                    for($j = 0; $j < count($starArr); $j++){
                        $data[$i][$starArr[$j]] = $row[$starArr[$j]];
                    }
                    $make = urlencode($row['make']);
                    $model = urlencode($row['model']);
                    $url = 	'https://wheatley.cs.up.ac.za/api/getimage?brand='.$make.'&model='.$model;
                    $imgLink = file_get_contents($url);
                    $data[$i]['image'] = $imgLink;
                }
                $i++;
            }
        }

        $response = array('status' => 'success', 'timestamp' => time(), 'data' => $data);
        echo json_encode($response);
        exit();
    }
?>