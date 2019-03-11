<?php
  class SearchesLog {
    private $db;

    public function __construct(){
      $this->db = new Database;
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
  }