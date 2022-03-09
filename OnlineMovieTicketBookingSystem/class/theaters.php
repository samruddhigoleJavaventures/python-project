<?php
    class Theater{
        // Connection
        private $conn;
        // Table
        private $db_table = "Theaters";
        private $db_second_table = "Movies";
        // Columns
        public $theaterid;
        public $theatername;
        public $cityid;
        public $movieid;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getTheaters(){
            $sqlQuery = "SELECT theaterid, theatername, cityid, movieid  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
    
        //CREATE
        public function createtheater(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        theaterid   =:theaterid,
                        theatername = :theatername,
                        cityid      = :cityid,
                        movieid     = :movieid";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->theaterid=htmlspecialchars(strip_tags($this->theaterid));
            $this->theatername=htmlspecialchars(strip_tags($this->theatername));
            $this->cityid=htmlspecialchars(strip_tags($this->cityid));
            $this->movieid=htmlspecialchars(strip_tags($this->movieid));

        
            // bind data
            $stmt->bindParam(":theaterid", $this->theaterid);
            $stmt->bindParam(":theatername", $this->theatername);
            $stmt->bindParam(":cityid", $this->cityid);
            $stmt->bindParam(":movieid", $this->movieid);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // READ single
        public function getSingleTheater(){
            $sqlQuery = "SELECT
                        theaterid, 
                        theatername,
                        cityid,
                        movieid
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       theaterid = ?
                    LIMIT 0,2";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->theaterid = $dataRow['theaterid'];
            $this->theatername = $dataRow['theatername'];
            $this->cityid = $dataRow['cityid'];
            $this->movieid = $dataRow['movieid'];
            
            
        }      
        
        //READ TWO TABLES
        public function getTheater(){
            $sqlQuery = "SELECT
                        theaterid, 
                        theatername,
                        cityid,
                        movieid
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       theaterid = ?
                    LIMIT 0,2";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->theaterid = $dataRow['theaterid'];
            $this->theatername = $dataRow['theatername'];
            $this->cityid = $dataRow['cityid'];
            $this->movieid = $dataRow['movieid'];
            
            
        }

        // UPDATE
        public function updatetheater(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        theaterid = :theaterid,
                        theatername = :theatername,
                        cityid = :cityid,
                        movieid = :movieid
                    WHERE 
                        theaterid = :theaterid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->theaterid=htmlspecialchars(strip_tags($this->theaterid));
            $this->theatername=htmlspecialchars(strip_tags($this->theatername));
            $this->cityid=htmlspecialchars(strip_tags($this->cityid));
            $this->movieid=htmlspecialchars(strip_tags($this->movieid));
            
        
            // bind data
            $stmt->bindParam(":theaterid", $this->theaterid);
            $stmt->bindParam(":theatername", $this->theatername);
            $stmt->bindParam(":cityid", $this->cityid);
            $stmt->bindParam(":movieid", $this->movieid);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }



        public function getTheaterMovies(){
            $sqlQuery = "SELECT
                        Movies.moviename,
                        Theaters.theatername
                      FROM
                        ". $this->db_second_table ."
                      INNER JOIN
                        ". $this->db_table ."
                      on 
                        Movies.movieid = Theaters.movieid
                    WHERE 
                       Theaters.theaterid = ?
                    LIMIT 0,2";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->moviename = $dataRow['moviename'];
            $this->theatername = $dataRow['theatername'];
            
            
        }

        public function getTheatersOfSingleMovie(){
            $sqlQuery = "SELECT
                        Movies.moviename,
                        Theaters.theatername
                      FROM
                        ". $this->db_second_table ."
                      INNER JOIN
                        ". $this->db_table ."
                      on 
                        Movies.movieid = Theaters.movieid
                    WHERE 
                       Movies.movieid = ?
                    LIMIT 0,4";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $result=$stmt->execute();
            $dataRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($dataRows as $dataRow){
            $this->moviename = $dataRow['moviename'];
            $this->theatername = $dataRow['theatername'];
            }
            
            
        }
    }
?>