<?php
    class Customers{
        // Connection
        private $conn;
        // Table
        private $db_table = "Customers";
        // Columns
        public $customerid;
        public $customername;
        public $customeremail;
        public $contactNumber;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getCustomers(){
            $sqlQuery = "SELECT customerid, customername, customeremail, contactNumber  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
    
        //CREATE
        public function createCustomer(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        customername = :customername, 
                        customeremail = :customeremail, 
                        contactNumber = :contactNumber";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->customername=htmlspecialchars(strip_tags($this->customername));
            $this->customeremail=htmlspecialchars(strip_tags($this->customeremail));
            $this->contactNumber=htmlspecialchars(strip_tags($this->contactNumber));
        
            // bind data
            $stmt->bindParam(":customername", $this->customername);
            $stmt->bindParam(":customeremail", $this->customeremail);
            $stmt->bindParam(":contactNumber", $this->contactNumber);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleCustomer(){
            $sqlQuery = "SELECT
                        customerid, 
                        customername, 
                        customeremail, 
                        contactNumber
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       customerid = ?
                    LIMIT 0,2";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->customername = $dataRow['customername'];
            $this->customeremail = $dataRow['customeremail'];
            $this->contactNumber = $dataRow['contactNumber'];
            
        }        
        // UPDATE
        public function updateCustomer(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        customername = :customername, 
                        customeremail = :customeremail, 
                        contactNumber = :contactNumber
                    WHERE 
                        customerid = :customerid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->customerid=htmlspecialchars(strip_tags($this->customerid));
            $this->customername=htmlspecialchars(strip_tags($this->customername));
            $this->customeremail=htmlspecialchars(strip_tags($this->customeremail));
            $this->contactNumber=htmlspecialchars(strip_tags($this->contactNumber));
            
        
            // bind data
            $stmt->bindParam(":customerid", $this->customerid);
            $stmt->bindParam(":customername", $this->customername);
            $stmt->bindParam(":customeremail", $this->customeremail);
            $stmt->bindParam(":contactNumber", $this->contactNumber);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteCustomer(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE customerid = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->customerid=htmlspecialchars(strip_tags($this->customerid));
        
            $stmt->bindParam(1, $this->customerid);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>