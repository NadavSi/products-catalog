<?php

class Products {
    public $data; 

    public function __construct(){  }

    /*
    * function works on data from results - removes unwanted results by search string and search criteria
    * renders view with data
    */
    public function index() {    
        $searchStr = isset($_GET['searchString']) ? $_GET['searchString'] : "";
        $searchCriteria = [];
        if (isset($_GET['cri'])) {
            $searchCriteria = $_GET['cri'] ;            
        }
        $results = $this->getCatalog();
         
        if($searchStr !== "") {
            $searchedResults = [];
            foreach ($results as $key => &$item) {
                foreach ($searchCriteria as $singleCriteria) {
                    //check if search string is in the result string by criteria - if so add to new array
                    if (strpos(strtolower($item[$singleCriteria]), $searchStr) !== false) { 
                        array_push($searchedResults,$item);                  
                        unset($results[$key]);
                        break;
                    }
                }
            } 
            
            //adds new log entry for search string and criteria
            $log = new SearchesLog;
            if ($log->logTableExist()) {
                $log->addSearchLog($searchStr, implode(',',$searchCriteria));
            }            
        } else {
            $searchedResults = $results;
        }
        //prepare data for view datatables
        $this->data = json_encode([
            'data'=>$searchedResults,
            'iTotalDisplayRecords'=>count($searchedResults),
            'iTotalRecords'=>intval(count($searchedResults)),
            'searchStr'=>$searchStr,
            'criteria'=>$searchCriteria
        ]);
        require_once 'Views/Products.php';
    }

    /*
    * function adds id to returned array of results from outside source - specific for assignment
    * return new array of results
    */
    private function getCatalog() {
        $results = HelperFunctions::xmlRequests("https://www.ushops.co.il/task/products_service.php");
        foreach ($results['product'] as $key => &$item) {
            $item['id'] = $key + 1; 
        } 
        return $results['product'];
    }
}