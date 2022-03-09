<?php
    class City{
        // Connection
        private $conn;
        // Table
        private $db_table = "City";
        // Columns
        public $cityid;
        public $cityname;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getCities(){
            $sqlQuery = "SELECT cityid, cityname  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
    
        //CREATE
        public function createcity(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        cityname = :cityname";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->cityname=htmlspecialchars(strip_tags($this->cityname));
        
            // bind data
            $stmt->bindParam(":cityname", $this->cityname);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // READ single
        public function getSingleCity(){
            $sqlQuery = "SELECT
                        cityid, 
                        cityname
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       cityid = ?
                    LIMIT 0,2";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->cityid = $dataRow['cityid'];
            $this->cityname = $dataRow['cityname'];
            
            
        }        
        // UPDATE
        public function updatecity(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        cityname = :cityname
                    WHERE 
                        cityid = :cityid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->cityid=htmlspecialchars(strip_tags($this->cityid));
            $this->cityname=htmlspecialchars(strip_tags($this->cityname));
            
        
            // bind data
            $stmt->bindParam(":cityid", $this->cityid);
            $stmt->bindParam(":cityname", $this->cityname);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // DELETE
        function deleteCity(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE cityid = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->cityid=htmlspecialchars(strip_tags($this->cityid));
        
            $stmt->bindParam(1, $this->cityid);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>