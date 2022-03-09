<?php
    class Showtimings{
        // Connection
        private $conn;
        // Table
        private $db_table = "Showtimings";
        private $db_second_table = "Movies";
        // Columns
        public $showtimingid;
        public $starttime;
        public $endtime;
        public $duration;
        public $movieid;
        public $theaterid;
        public $totalseats;
        public $bookedseates;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getShotimings(){
            $sqlQuery = "SELECT showtimingid, starttime, endtime, duration, movieid, theaterid, totalseats,  bookedseates FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
    
        // //CREATE
        // public function createcity(){
        //     $sqlQuery = "INSERT INTO
        //                 ". $this->db_table ."
        //             SET
        //                 cityname = :cityname";
                        
        
        //     $stmt = $this->conn->prepare($sqlQuery);
        
        //     // sanitize
        //     $this->cityname=htmlspecialchars(strip_tags($this->cityname));
        
        //     // bind data
        //     $stmt->bindParam(":cityname", $this->cityname);
            
        
        //     if($stmt->execute()){
        //        return true;
        //     }
        //     return false;
        // }


        //  READ Showtimings for perticular movie
        public function getShowtimingsForMovie(){
            $sqlQuery = "SELECT
                        Showtimings.starttime, 
                        Showtimings.endtime,
                        Showtimings.theaterid,
                        Movies.moviename
                      FROM
                        ". $this->db_second_table ."
                      INNER JOIN
                        ". $this->db_table ."
                      ON
                        Showtimings.movieid = Movies.movieid
                    WHERE 
                       Showtimings.movieid = ?
                    LIMIT 0,2";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            
            $this->starttime = $dataRow['starttime'];
            $this->endtime = $dataRow['endtime'];
            $this->duration = $dataRow['duration'];
            $this->moviename = $dataRow['moviename'];
            $this->theaterid = $dataRow['theaterid'];

            
            
        }        
    }
?>