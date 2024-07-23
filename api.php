<?php
    header('Content-Type: application/json');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    class Database {
        private $connection = null;

        public static function instance() {
            static $instance = null;
            if($instance === null) $instance = new Database();
            return $instance;
        }

        private function __construct() { // Connect to the database 
            $host = "wheatley.cs.up.ac.za";
            $username = "u22561154";
            $password = "6SGC6BFVL4LPHW2ELWRMQMQMNOY6GADV";

            try {
                
                $this->connection = new PDO("mysql:host=$host;dbname=u22561154_",$username, $password);
                
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $error) {
                echo "Connection failure: " . $error->getMessage();
                exit;
            }
        }

        public function __destruct() { // Disconnect from the database
            $this->connection = null;
        }
        // checking for api key on the database
        public function api_Key_Exist($apikey) {
            $query = $this->connection->prepare('SELECT * FROM userdb WHERE APIkey = :APIkey');
            $query->bindParam(':APIkey', $apikey);
            $query->execute();
            $user = $query->fetch();

            if ($user !== false) {
                return true;
            } else {
                return false;
            }
        }

        private function getImage($brand, $model) {
            // urlencode to avoid 400 bad request status
            $url = "https://wheatley.cs.up.ac.za/api/getimage?brand=" . urlencode($brand) . "&model=" . urlencode($model) ;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            curl_close($ch);
            return $res;
        }

        private function getOutput($result, $return) {

            if ($result !== false) {
                $data = array();
                foreach($result as $car) {
                    if ($return === '*' || in_array('image', $return))
                    {
                        $car['image'] = $this->getImage($car['make'], $car['model']);
                    }
                    array_push($data, $car);
                }

                $array = [
                    "status" => "success",
                    "timestamp"=> time(),
                    "data" => $data
                ];
                return $array;
            } else {

                $error = array(
                    "status"=> "error",
                    "timestamp"=> time(),
                    "data"=> "Unable to get query data"
                );
                return $error;
            }
        }

        private function get_Table_Column_String($return) {
            $table_column="";

            if ($return === '*') {
                $table_column = '*';
            } else {
                $index = array_search('image', $return);
                if ($index !== false) {
                    unset($return[$index]);
                }
                $data = array();
                foreach($return as $field) {
                    array_push($data,  filter_var($field, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                }
                $table_column = implode(',', $data);
            }

            return $table_column;
        }

        private function is_searchable($search) {
            
            if (is_array($search)) {
                
                // [make, model,body_type, engine_type, transmission]
                $count = 0;
                $columns_array = ['make', 'model', 'body_type', 'engine_type', 'transmission'];

                foreach($columns_array as $col) {  
                    if (array_key_exists($col, $search)) {
                        $count = $count + 1;
                    } 
                }

                $num_properties = count($search);
               
                if ($count === $num_properties) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        private function get_fuzy_search($search, $fuzzy) {
            $fuzy_search = '';
            $columns_array = ['make', 'model', 'body_type', 'engine_type', 'transmission'];

            foreach($columns_array as $col) {
                if (array_key_exists($col, $search)) {
                    if ($fuzzy) {
                        $fuzy_search = $fuzy_search . $col . " LIKE '%" . filter_var($search[$col], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "%' OR ";
                    } else {
                        $fuzy_search = $fuzy_search . $col . " = '" .  filter_var($search[$col], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "' OR ";
                    }
                } 
            }

            return substr($fuzy_search, 0, -3);
        }

        public function getAllCars($return, $offset, $limit) {

            $table_column = $this->get_Table_Column_String($return);

            $query = $this->connection->prepare('SELECT ' . $table_column .' FROM cars LIMIT :offset, :limit');
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->bindParam(':limit', $limit, PDO::PARAM_INT);
            $query->execute();
            $result =  $query->fetchAll(PDO::FETCH_ASSOC);

            return $this->getOutput($result, $return);
        }

        // All parameters set return
        public function getAllSet($offset, $limit, $sort, $search, $order, $fuzzy, $return) {
            $is_searchable = $this->is_searchable($search);

            if ($is_searchable) {

                $table_column = $this->get_Table_Column_String($return);
                $search = $this->get_fuzy_search($search, $fuzzy);

                $query = $this->connection->prepare('SELECT ' . $table_column .' FROM cars WHERE '. $search . ' ORDER BY ' . $sort . ' ' . $order .' LIMIT :offset, :limit');
                $query->bindParam(':offset', $offset, PDO::PARAM_INT);
                $query->bindParam(':limit', $limit, PDO::PARAM_INT);
                $query->execute();
                $result =  $query->fetchAll(PDO::FETCH_ASSOC);
                return $this->getOutput($result, $return);

            } else {
                $error = array(
                    "status"=> "error",
                    "timestamp"=> time(),
                    "data"=> "search property is not object or contain unauthorized property"
                );
                return $error;
            }
        }

        // limit, sort and order
        public function get_limit_sort_order($offset, $limit, $sort, $order, $return) {
            
            $table_column = $this->get_Table_Column_String($return);
            $query = $this->connection->prepare('SELECT ' . $table_column .' FROM cars ORDER BY ' . $sort . ' ' . $order .' LIMIT :offset, :limit');
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->bindParam(':limit', $limit, PDO::PARAM_INT);
            $query->execute();
            $result =  $query->fetchAll(PDO::FETCH_ASSOC);
            return $this->getOutput($result, $return);
        }

        // limit, search and fuzzy
        public function get_limit_search_fuzzy($offset, $limit, $search, $fuzzy, $return) {
            $is_searchable = $this->is_searchable($search);

            if ($is_searchable) {

                $table_column = $this->get_Table_Column_String($return);
                $search = $this->get_fuzy_search($search, $fuzzy);

                $query = $this->connection->prepare('SELECT ' . $table_column .' FROM cars WHERE '. $search . ' LIMIT :offset, :limit');
                $query->bindParam(':offset', $offset, PDO::PARAM_INT);
                $query->bindParam(':limit', $limit, PDO::PARAM_INT);
                $query->execute();
                $result =  $query->fetchAll(PDO::FETCH_ASSOC);
                return $this->getOutput($result, $return);

            } else {
                $error = array(
                    "status"=> "error",
                    "timestamp"=> time(),
                    "data"=> "search property is not object or contain unauthorized property"
                );
                return $error;
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST)) {
            $request_body = file_get_contents('php://input');
            $_POST = json_decode($request_body, true);
        }

        if (isset($_POST['apikey']) && isset($_POST['type']) && isset($_POST['return'])) {

            if ($_POST['type'] === 'GetAllCars') { // check type
                $is_correct_return_type = false;
                $errorValue='';

                if (is_array($_POST['return'])) {
                    $field = array('id_trim', 'make', 'model', 'generation', 'year_from', 'year_to', 'series', 'trim', 'body_type', 'number_of_seats', 'length_mm', 'width_mm', 'height_mm', 'number_of_cylinders', 'engine_type', 'drive_wheels', 'transmission', 'max_speed_km_per_h', 'image');
                    foreach ($_POST['return'] as $value) {
                        if(in_array($value, $field)) {
                            $is_correct_return_type = true;
                        } else {
                            $is_correct_return_type = false;
                            $errorValue = $value;
                            break;
                        }
                    }

                } else if (is_string($_POST['return'])) {
                    if ($_POST['return'] === '*') {
                        $is_correct_return_type = true;
                    }
                }

                if ($is_correct_return_type) {

                    $database = Database::instance();
        
                    if ($database->api_Key_Exist(filter_var($_POST['apikey'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))) {
                        
                        // ALL SET
                        if (isset($_POST['limit']) && isset($_POST['sort']) && isset($_POST['search'])) {
                           
                            if (isset($_POST['order'])) { // order set
                                if ($_POST['order'] === 'ASC' || $_POST['order'] === 'DESC') {
                                    // $database->getAllSet($offset, $limit, $sort, $search, $order, $fuzzy, $return)
                                    if (isset($_POST['fuzzy'])) {
                                        echo json_encode($database->getAllSet(0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['sort'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['search'], filter_var($_POST['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ,filter_var($_POST['fuzzy'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['return']));
                                    } else {
                                        echo json_encode($database->getAllSet(0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['sort'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['search'], filter_var($_POST['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),true, $_POST['return']));
                                    }
                                } else {
                                    $error = array(
                                        "status"=> "error",
                                        "timestamp"=> time(),
                                        "data"=> "Incorrect order"
                                    );
                                    echo json_encode($error);
                                }
                            } else { // order not set
                                if (isset($_POST['fuzzy'])) {
                                    //  get_limit_search_fuzzy
                                    echo json_encode($database->get_limit_search_fuzzy(0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['fuzzy'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['return']));
                                } else {
                                    echo json_encode($database->get_limit_search_fuzzy(0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), true, $_POST['return']));
                                }
                            }   
                        } else if (isset($_POST['limit'])) { // limit set
                            if (isset($_POST['sort']) && !isset($_POST['search'])) { // sort set
                                if (isset($_POST['order'])) { // order set
                                    if ($_POST['order'] === 'ASC' || $_POST['order'] === 'DESC') {
                                        //get_limit_sort_order($offset, $limit, $sort, $order, $return)
                                        echo json_encode($database->get_limit_sort_order(0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['sort'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['return']));
                                    } else {
                                        $error = array(
                                            "status"=> "error",
                                            "timestamp"=> time(),
                                            "data"=> "Incorrect order"
                                        );
                                        echo json_encode($error);
                                    }
                                } else { // oder not set
                                    echo json_encode($database->getAllCars($_POST['return'], 0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
                                }
                            } else if (isset($_POST['search'])) { // search set
                                if (isset($_POST['fuzzy'])) {
                                    //  get_limit_search_fuzzy
                                    echo json_encode($database->get_limit_search_fuzzy(0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['search'], filter_var($_POST['fuzzy'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['return']));
                                } else {
                                    echo json_encode($database->get_limit_search_fuzzy(0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['search'], true, $_POST['return']));
                                }
                                
                            } else { // only limit is set
                                echo json_encode($database->getAllCars($_POST['return'], 0, filter_var($_POST['limit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
                            }
                        } else if (isset($_POST['sort'])) {
                            if (isset($_POST['search'])) {
                                if (isset($_POST['order']) && ($_POST['order'] === 'ASC' || $_POST['order'] === 'DESC')) {
                                    // $database->getAllSet($offset, $limit, $sort, $search, $order, $fuzzy, $return)
                                    if (isset($_POST['fuzzy'])) {
                                        echo json_encode($database->getAllSet(0, 25, filter_var($_POST['sort'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['search'], filter_var($_POST['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ,filter_var($_POST['fuzzy'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['return']));
                                    } else {
                                        echo json_encode($database->getAllSet(0, 25, filter_var($_POST['sort'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['search'], filter_var($_POST['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),true, $_POST['return']));
                                    }
                                } else {
                                    $error = array(
                                        "status"=> "error",
                                        "timestamp"=> time(),
                                        "data"=> "Incorrect order"
                                    );
                                    echo json_encode($error);
                                }
                            } else { 
                                if (isset($_POST['order'])) { // order set
                                    if ($_POST['order'] === 'ASC' || $_POST['order'] === 'DESC') {
                                        //get_limit_sort_order($offset, $limit, $sort, $order, $return)
                                        echo json_encode($database->get_limit_sort_order(0, 25, filter_var($_POST['sort'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), filter_var($_POST['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['return']));
                                    } else {
                                        $error = array(
                                            "status"=> "error",
                                            "timestamp"=> time(),
                                            "data"=> "Incorrect order"
                                        );
                                        echo json_encode($error);
                                    }
                                } else { // oder not set
                                    echo json_encode($database->getAllCars($_POST['return'], 0, 25));
                                }
                            }   
                        } else if (isset($_POST['search'])) { // search set
                            if (isset($_POST['fuzzy'])) {
                                //  get_limit_search_fuzzy
                                echo json_encode($database->get_limit_search_fuzzy(0, 25, $_POST['search'], filter_var($_POST['fuzzy'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), $_POST['return']));
                            } else {
                                echo json_encode($database->get_limit_search_fuzzy(0, 25, $_POST['search'], true, $_POST['return']));
                            }
                            
                        } else { // only required set
                            echo json_encode($database->getAllCars($_POST['return'], 0, 25));
                        }
                        
                    } else {
                        $error = array(
                            "status"=> "error",
                            "timestamp"=> time(),
                            "data"=> "Error. API KEY: " . $_POST['apikey'] . "  Doesn't Exist"
                        );
                        echo json_encode($error);
                    }            
                } else {
                    if (is_array($_POST['return'])) {
                        $error = array(
                            "status"=> "error",
                            "timestamp"=> time(),
                            "data"=> "Error. Incorrect field: " . $errorValue
                        );
                        echo json_encode($error);

                    } else if (is_string($_POST['return'])) {
                        $error = array(
                            "status"=> "error",
                            "timestamp"=> time(),
                            "data"=> "Error. wildcard '*' not used"
                        );
                        echo json_encode($error);
                    }
                }

            } else {
                $error = array(
                    "status"=> "error",
                    "timestamp"=> time(),
                    "data"=> "Error. Incorrect type"
                );
                echo json_encode($error);
            }


        } else {
            $error = array(
                "status"=> "error",
                "timestamp"=> time(),
                "data"=> "Error. Post paramters are missing"
            );
            echo json_encode($error);
        }
    } else {
        $error = array(
            "status"=> "error",
            "timestamp"=> time(),
            "data"=> "Error. Incorrect Method"
        );
        echo json_encode($error);
    }
?>