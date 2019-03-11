<?php
  class SearchesLog {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    /*
    * function checks if log table exist and if not creates it
    * return boolean
    */
    public function logTableExist(){
        $this->db->query("SELECT * FROM information_schema.tables WHERE table_schema = '" . DB_NAME . "' AND table_name = 'searchlog' LIMIT 1");
        // Execute
        $this->db->execute();
        if($this->db->rowCount() > 0) {
          return true;
        } else {
          return $this->createLogTable();
        }
    }

    /*
    * function get all log entries from db
    * return array
    */
    public function getSearchLog(){
        $this->db->query('SELECT * FROM `searchlog`');

        $results = $this->db->resultSet();

        return $results;
    }

    /*
    * function adds entry to db
    * $searchStr - input given for search by user
    * $searchCriteria - search criteria selected by user
    */
    public function addSearchLog($searchStr,$searchCriteria){
        $this->db->query('INSERT INTO `searchlog` (search_string, search_criteria, user_ip) VALUES(:searchStr, :searchCri, :user_ip)');
        // Bind values
        $this->db->bind(':searchStr', $searchStr);
        $this->db->bind(':searchCri', $searchCriteria);
        $this->db->bind(':user_ip', $_SERVER['SERVER_ADDR']);

        // Execute
        if($this->db->execute()){
          return true;
      } else {
          return false;
      }
    }

    private function createLogTable(){
        $sqlStr = "CREATE TABLE `searchlog` (";
        $sqlStr .= "`id` int(11) NOT NULL AUTO_INCREMENT,";
        $sqlStr .=  "`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,";
        $sqlStr .=  "`search_string` varchar(100) NOT NULL,";
        $sqlStr .= "`search_criteria` varchar(10) NOT NULL,";
        $sqlStr .=  "`user_ip` varchar(20) NOT NULL,";
        $sqlStr .=  "PRIMARY KEY (`id`))";
        $this->db->query($sqlStr);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
  }