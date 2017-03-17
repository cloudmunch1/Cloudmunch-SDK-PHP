<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi Chandy rosmi@cloudmunch.com
 */
namespace CloudMunch\helper;

use \DateTime;
use CloudMunch\datamanager\CMDataManager;
use CloudMunch\AppContext;
use CloudMunch\loghandling\LogHandler;
use CloudMunch\CloudmunchService;
use Cloudmunch\CloudmunchConstants;

/**
 * This is a helper class for Insight plugins.Several helper methods to interact with CloudMunch Data Stores and
 * Resources are provided here.
 * Helper methods to extract sprint details, create key metrics are available.
 *
 * @package CloudMunch
 * @author Amith <amith@cloudmunch.com>
 */
class InsightHelper {
 const RESOURCES = "resources";
 const FIELDS = "fields";
 const FILTER = "filter";
 const DEBUG = 'DEBUG';
 const ERROR = 'ERROR';
 const EXTRACTS = 'extracts';
 const DATASTORES = 'datastores';
 const INSIGHT_REPORTS = 'insight_reports';
 const INSIGHT_CARDS = 'insight_cards';
 const DATE_VALUE = 'Y-m-d';
 const SPRINT = 'sprint';
 const LABEL = 'label';
 const TOLERANCE_STATE = 'toleranceState';
 const TOLERANCE_DESCRIPTION = 'toleranceDescription';
 const TOLERANCE_HIT = 'toleranceHit';
 const KANBAN = 'kanban';
 /**
  *
  * @var CloudMunch\AppContext Reference to application context
  */
 private $appContext = null;
 
 /**
  *
  * @var CloudMunch\datamanager\CMDataManager Reference to CloudMunch data manager.
  */
 private $cmDataManager = null;
 
 /**
  *
  * @var CloudMunch\loghandling\LogHandler Reference to log handler.
  */
 private $logHelper = null;
 
 /**
  *
  * @var CloudMunch\CloudmunchService Reference to CloudMunch service.
  */
 private $cmService = null;
 
 /**
  * Initialize appcontext and loghandler.
  *
  * @param
  *         object appContext : data and methods available for this context
  * @param
  *         object logHandler : handler to print differrent types of messages
  */
 public function __construct($appContext, $logHandler) {
  $this->appContext = $appContext;
  $this->logHelper = $logHandler;
  $this->cmService = new CloudmunchService ( $appContext, $this->logHelper );
  $this->cmDataManager = new CMDataManager ( $this->logHelper, $appContext );
 }
 
 /**
  * Get all the resource from CMDB with given type.
  *
  * @param string $type
  *         type of resource.
  * @param array $filter
  *         List of filter data.
  *         
  * @return array resources available with given type
  */
 public function getResources($type, $filter = null) {
  if ($type) {
   $contextArray = array (
     static::RESOURCES => '' 
   );
   $queryOptions = array ();
   $queryOptions [static::FIELDS] = '*';
   $queryOptions [static::FILTER] = array ();
   
   if ($filter && is_array ( $filter ) && count ( $filter ) > 0) {
    $queryOptions [static::FILTER] = $filter;
   }
   $queryOptions [static::FILTER] ['type'] = $type;
   return $this->cmService->getCustomContextData ( $contextArray, $queryOptions );
  } else {
   $this->logHelper->log ( static::DEBUG, 'Resource type is not provided!' );
   return false;
  }
 }
 
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * ************************* INSIGHT GET API UTILITIES ************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 
 /**
  * Get all extracts under provided resource and datastore.
  *
  * @param string $insightID         
  * @param string $dataStoreID         
  * @param array $queryOptions
  *         associative array with key as query key and query value as value
  * @param string $extractID         
  *
  * @return json object of extract details
  */
 public function getInsightDataStoreExtracts($insightID, $dataStoreID, $queryOptions, $extractID = '') {
  if (is_null ( $insightID ) || empty ( $insightID ) || is_null ( $dataStoreID ) || empty ( $dataStoreID )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id and datastore id is needed to gets its extract details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::DATASTORES => $dataStoreID,
    static::EXTRACTS => $extractID 
  );
  return $this->cmService->getCustomContextData ( $params, $queryOptions );
 }
 
 /**
  * Get all datastores under provided resource.
  *
  * @param string $insightID         
  * @param array $queryOptions
  *         associative array with key as query key and query value as value
  * @param string $dataStoreID         
  *
  * @return json object of datastore details
  */
 public function getInsightDataStores($insightID, $queryOptions, $dataStoreID = '') {
  if (is_null ( $insightID ) || empty ( $insightID )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id is needed to gets its datastore details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::DATASTORES => $dataStoreID 
  );
  
  return $this->cmService->getCustomContextData ( $params, $queryOptions );
 }
 
 /**
  * Get all report cards under provided resource and report.
  *
  * @param string $insightID         
  * @param string $reportID         
  * @param array $queryOptions
  *         associative array with key as query key and query value as value
  * @param string $cardID         
  *
  * @return json object of report card details
  */
 public function getInsightReportCards($insightID, $reportID, $queryOptions, $cardID = '') {
  if (is_null ( $insightID ) || empty ( $insightID ) || is_null ( $reportID ) || empty ( $reportID )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id and report id is needed to gets its report card details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::INSIGHT_REPORTS => $reportID,
    static::INSIGHT_CARDS => $cardID 
  );
  
  return $this->cmService->getCustomContextData ( $params, $queryOptions );
 }
 
 /**
  * Get all reports under provided resource.
  *
  * @param string $insightID         
  * @param array $queryOptions
  *         associative array with key as query key and query value as value
  * @param string $reportID         
  *
  * @return json object of report details
  */
 public function getInsightReports($insightID, $queryOptions, $reportID = '') {
  if (is_null ( $insightID ) || empty ( $insightID )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id is needed to gets its report details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::INSIGHT_REPORTS => $reportID 
  );
  
  return $this->cmService->getCustomContextData ( $params, $queryOptions );
 }
 
 /**
  * Get extractID for provided extract name.
  *
  * @param string $insightID         
  * @param string $dataStoreID         
  * @param string $extractName         
  *
  * @return string extract id
  */
 public function getInsightDataStoreExtractID($insightID, $dataStoreID, $extractName) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isDataStoreIDEmpty = is_null ( $dataStoreID ) || empty ( $dataStoreID );
  $isExtractNameEmpty = is_null ( $extractName ) || empty ( $extractName );
  
  if ($isInsightIDEmpty || $isDataStoreIDEmpty || $isExtractNameEmpty) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, datastore id and extract name is needed to get extract id' );
   return false;
  }
  
  $queryOptions = array (
    static::FILTER => array (
      'name' => $extractName 
    ) 
  );
  $response = $this->getInsightDataStoreExtracts ( $insightID, $dataStoreID, $queryOptions );
  
  if ($response) {
   return $response [0]->id;
  } else {
   return false;
  }
 }
 
 /**
  * Get dataStoreID for provided datastore name.
  *
  * @param string $insightID         
  * @param string $dataStoreName         
  *
  * @return string datastore id
  */
 public function getInsightDataStoreID($insightID, $dataStoreName) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  if ($isInsightIDEmpty || is_null ( $dataStoreName ) || empty ( $dataStoreName )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id and datastore name is needed to get datastore id' );
   
   return false;
  }
  
  $queryOptions = array (
    static::FILTER => array (
      "name" => $dataStoreName 
    ) 
  );
  
  $response = $this->getInsightDataStores ( $insightID, $queryOptions );
  
  if ($response) {
   return $response [0]->id;
  } else {
   return false;
  }
 }
 
 /**
  * Get reportcardID for provided card name.
  *
  * @param string $insightID         
  * @param string $reportID         
  * @param string $cardName         
  *
  * @return string card id
  */
 public function getInsightReportCardID($insightID, $reportID, $cardName) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isReportIDEmpty = is_null ( $reportID ) || empty ( $reportID );
  $isCardNameEmpty = is_null ( $cardName ) || empty ( $cardName );
  
  if ($isInsightIDEmpty || $isReportIDEmpty || $isCardNameEmpty) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, report id and card name is needed to get report card id' );
   
   return false;
  }
  
  $queryOptions = array (
    static::FILTER => array (
      "name" => $cardName 
    ) 
  );
  
  $response = $this->getInsightReportCards ( $insightID, $reportID, $queryOptions );
  
  if ($response) {
   return $response [0]->id;
  } else {
   return false;
  }
 }
 
 /**
  * Get reportID for provided report name.
  *
  * @param string $insightID         
  * @param string $reportName         
  *
  * @return string report id
  */
 public function getInsightReportID($insightID, $reportName) {
  if (is_null ( $insightID ) || empty ( $insightID ) || is_null ( $reportName ) || empty ( $reportName )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id and report name is needed to get report id' );
   
   return false;
  }
  
  $queryOptions = array (
    static::FILTER => array (
      "name" => $reportName 
    ) 
  );
  
  $response = $this->getInsightReports ( $insightID, $queryOptions );
  
  if ($response) {
   return $response [0]->id;
  } else {
   return false;
  }
 }
 
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * *********************** INSIGHT PATCH API UTILITIES ************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 
 /**
  * Update an extract with provided data.
  *
  * @param string $insightID         
  * @param string $dataStoreID         
  * @param string $extractID         
  * @param string $data         
  *
  * @return json object of extract details
  */
 public function updateInsightDataStoreExtract($insightID, $dataStoreID, $extractID, $data) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isDataStoreIDEmpty = is_null ( $dataStoreID ) || empty ( $dataStoreID );
  $isExtractIDEmpty = is_null ( $extractID ) || empty ( $extractID );
  
  if ($isInsightIDEmpty || $isDataStoreIDEmpty || $isExtractIDEmpty || is_null ( $data )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, datastore id, extract id and data is needed to update extract details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::DATASTORES => $dataStoreID,
    static::EXTRACTS => $extractID 
  );
  
  return $this->cmService->updateCustomContextData ( $params, $data );
 }
 
 /**
  * Update a report with provided data.
  *
  * @param string $insightID         
  * @param string $dataStoreID         
  * @param string $data         
  *
  * @return json object of datastore details
  */
 public function updateInsightDataStore($insightID, $dataStoreID, $data) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isDataStoreIDEmpty = is_null ( $dataStoreID ) || empty ( $dataStoreID );
  
  if ($isInsightIDEmpty || $isDataStoreIDEmpty || is_null ( $data )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, datastore id and data is needed to update datastore details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::DATASTORES => $dataStoreID 
  );
  
  return $this->cmService->updateCustomContextData ( $params, $data );
 }
 
 /**
  * Update a report card with provided data.
  *
  * @param string $insightID         
  * @param string $reportID         
  * @param string $cardID         
  * @param string $data         
  *
  * @return json object of extract details
  */
 public function updateInsightReportCard($insightID, $reportID, $cardID, $data) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isReportIDEmpty = is_null ( $reportID ) || empty ( $reportID );
  $isCardIDEmpty = is_null ( $cardID ) || empty ( $cardID );
  
  if ($isInsightIDEmpty || $isReportIDEmpty || $isCardIDEmpty || is_null ( $data )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, report id, card id and data is needed to update report card details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::INSIGHT_REPORTS => $reportID,
    static::INSIGHT_CARDS => $cardID 
  );
  
  return $this->cmService->updateCustomContextData ( $params, $data );
 }
 
 /**
  * Update a report with provided data.
  *
  * @param string $insightID         
  * @param string $reportID         
  * @param string $data         
  *
  * @return json object of report details
  */
 public function updateInsightReport($insightID, $reportID, $data) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isReportIDEmpty = is_null ( $reportID ) || empty ( $reportID );
  
  if ($isInsightIDEmpty || $isReportIDEmpty || is_null ( $data )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, report id and data is needed to update report card details' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID,
    static::INSIGHT_REPORTS => $reportID 
  );
  
  return $this->cmService->updateCustomContextData ( $params, $data );
 }
 
 /**
  * Update a resource with provided data.
  *
  * @param string $insightID         
  * @param string $data         
  *
  * @return json object of resource details
  */
 public function updateResource($insightID, $data) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  
  if ($isInsightIDEmpty || is_null ( $data )) {
   $this->logHelper->log ( static::DEBUG, 'Resource id, and data is needed to update a resource' );
   
   return false;
  }
  
  $params = array (
    static::RESOURCES => $insightID 
  );
  
  return $this->cmService->updateCustomContextData ( $params, $data );
 }
 
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * *********************** INSIGHT POST API UTILITIES *************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 
 /**
  * Create an extract if it does not exist.
  *
  * @param string $insightID         
  * @param string $dataStoreID         
  * @param string $extractName         
  * @param array $data         
  * @return string extract id
  */
 public function createInsightDataStoreExtract($insightID, $dataStoreID, $extractName, $data = array()) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isDataStoreIDEmpty = is_null ( $dataStoreID ) || empty ( $dataStoreID );
  $isExtractNameEmpty = is_null ( $extractName ) || empty ( $extractName );
  
  if ($isInsightIDEmpty || $isDataStoreIDEmpty || $isExtractNameEmpty) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, datastore id and extract name is needed to create an extract' );
   return false;
  }
  
  $extractID = null;
  $extractID = $this->getInsightDataStoreExtractID ( $insightID, $dataStoreID, $extractName );
  
  $this->logHelper->log ( static::DEBUG, 'Attempting creation of extract with name ' . $extractName . '...' );
  
  $params = array (
    static::RESOURCES => $insightID,
    static::DATASTORES => $dataStoreID,
    static::EXTRACTS => '' 
  );
  
  if (! $extractID) {
   $data ['name'] = $extractName;
   $response = $this->cmService->updateCustomContextData ( $params, $data, "POST" );
  } elseif ($extractID && is_array ( $data ) && count ( $data ) > 0) {
   $response = $this->updateInsightDataStoreExtract ( $insightID, $dataStoreID, $extractID, $data );
  }
  
  if ($response) {
   $extractID = $response->id;
  } else {
   $extractID = false;
  }
  return $extractID;
 }
 
 /**
  * Create a datastore if it does not exist.
  *
  * @param string $insightID         
  * @param string $dataStoretName         
  *
  * @return string dataStore id
  */
 public function createInsightDataStore($insightID, $dataStoretName) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isDataStoretNameEmpty = is_null ( $dataStoretName ) || empty ( $dataStoretName );
  
  if ($isInsightIDEmpty || $isDataStoretNameEmpty) {
   $this->logHelper->log ( static::DEBUG, 'Insight id and datastore name is needed to create a datastore' );
   return false;
  }
  
  $dataStoreID = null;
  $dataStoreID = $this->getInsightDataStoreID ( $insightID, $dataStoretName );
  
  if (! $dataStoreID) {
   $this->logHelper->log ( static::DEBUG, 'Attempting creation of datastore with name ' . $dataStoretName . '...' );
   
   $params = array (
     static::RESOURCES => $insightID,
     static::DATASTORES => '' 
   );
   $data = array (
     'name' => $dataStoretName 
   );
   
   $response = $this->cmService->updateCustomContextData ( $params, $data, "POST" );
   
   if ($response) {
    $dataStoreID = $response->id;
   } else {
    $dataStoreID = false;
   }
  }
  return $dataStoreID;
 }
 
 /**
  * Create a report card if it does not exist.
  *
  * @param string $insightID         
  * @param string $reportID         
  * @param string $cardName         
  *
  * @return string report card id
  */
 public function createInsightReportCard($insightID, $reportID, $cardName) {
  $isInsightIDEmpty = is_null ( $insightID ) || empty ( $insightID );
  $isReportIDEmpty = is_null ( $reportID ) || empty ( $reportID );
  $isCardNameEmpty = is_null ( $cardName ) || empty ( $cardName );
  
  if ($isInsightIDEmpty || $isReportIDEmpty || $isCardNameEmpty) {
   $this->logHelper->log ( static::DEBUG, 'Insight id, report id and report card name is needed to create a report card' );
   return false;
  }
  
  $cardID = null;
  $cardID = $this->getInsightReportCardID ( $insightID, $reportID, $cardName );
  
  if (! $cardID) {
   $this->logHelper->log ( 'INFO', 'Attempting creation of report card with name ' . $cardName . '...' );
   
   $params = array (
     static::RESOURCES => $insightID,
     static::INSIGHT_REPORTS => $reportID,
     static::INSIGHT_CARDS => '' 
   );
   $data = array (
     'name' => $cardName 
   );
   
   $response = $this->cmService->updateCustomContextData ( $params, $data, "POST" );
   
   if ($response) {
    $cardID = $response->id;
   } else {
    $cardID = false;
   }
  }
  return $cardID;
 }
 
 /**
  * Create a report if it does not exist.
  *
  * @param string $insightID         
  * @param string $reportName         
  *
  * @return string report id
  */
 public function createInsightReport($insightID, $reportName) {
  if (is_null ( $insightID ) || empty ( $insightID ) || is_null ( $reportName ) || empty ( $reportName )) {
   $this->logHelper->log ( static::DEBUG, 'Insight id and report name is needed to create a report' );
   return false;
  }
  
  $reportID = null;
  $reportID = $this->getInsightReportId ( $insightID, $reportName );
  
  if (! $reportID) {
   $this->logHelper->log ( 'INFO', 'Attempting creation of report with name ' . $reportName . '...' );
   
   $params = array (
     static::RESOURCES => $insightID,
     static::INSIGHT_REPORTS => '' 
   );
   $data = array (
     'name' => $reportName 
   );
   
   $response = $this->cmService->updateCustomContextData ( $params, $data, "POST" );
   if ($response) {
    $reportID = $response->id;
   } else {
    $reportID = false;
   }
  }
  return $reportID;
 }
 
 /**
  * Create a resource.
  * 
  * @param string $resourceName         
  * @param string $type         
  * @param array $data         
  * @return boolean
  */
 public function createResource($resourceName, $type, $data = null) {
  if (is_null ( $resourceName ) || empty ( $resourceName ) || is_null ( $type ) || empty ( $type )) {
   $this->logHelper->log ( static::DEBUG, 'Resource name and type is needed to create a resource' );
   return false;
  }
  $resourceID = false;
  $resources = $this->getResources ( $type, array (
    'name' => $resourceName 
  ) );
  
  if ($resources && is_array ( $resources ) && $resources [0]) {
   $resourceID = $resources [0]->id ? $resources [0]->id : false;
  } else {
   $this->logHelper->log ( 'INFO', 'Attempting creation of resource with name ' . $resourceName . ' and type ' . $type . ' ...' );
   
   $params = array (
     static::RESOURCES => '' 
   );
   
   $data = $data && is_array ( $data ) && count ( $data ) > 0 ? $data : array ();
   $data ['name'] = $resourceName;
   $data ['type'] = $type;
   
   $response = $this->cmService->updateCustomContextData ( $params, $data, "POST" );
   $resourceID = $response && $response->id ? $response->id : false;
  }
  return $resourceID;
 }
 
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * ************************* INSIGHT SPRINT UTILITIES *************************
  */
 /**
  * ****************************************************************************
  */
 /**
  * ****************************************************************************
  */
 
 /**
  * Get range of sprints available from jira resource.
  *
  *
  * @return dateRangeForSprints range of sprint dates
  */
 public function sprint_getDateRangeForAllSprints() {
  $sprintsDetailsArray = $this->sprint_getSprintDetailsFromJiraCMDB ();
  $dateRangeForSprints = array ();
  if ($sprintsDetailsArray) {
   $sprints = array_reverse ( $this->sprint_getSprintsWithDates ( $sprintsDetailsArray ) );
   $dateRangeForSprints = array ();
   $sprintCount = 0;
   foreach ( $sprints as $k => $val ) {
    $sprintID = $k;
    $filterStrForDateRange = $this->sprint_giveAFilterStringForASprint ( $sprints, $sprintID );
    $sprintName = "S" . ( string ) $sprintCount;
    $dateRangeForSprints [$sprintName] = $filterStrForDateRange;
    $sprintCount ++;
   }
   return $dateRangeForSprints;
  }
 }
 
 /**
  * Construct an array for sprints with dates.
  *
  *
  * @param
  *         array sprintDetailsArray
  *         
  * @return dateRangeForSprints range of sprint dates
  */
 public function sprint_getSprintsWithDates($sprintDetailsArray) {
  $sprintHash = array ();
  foreach ( $sprintDetailsArray as $arrElemHash ) {
   $sprintData = $arrElemHash->data->sprints;
   
   if ($sprintData->startDate != "None" && $sprintData->endData != "None") {
    $sprintHashData = array ();
    $startDate = DateTime::createFromFormat ( 'd/M/y H:i a', $sprintData->startDate );
    $endDate = DateTime::createFromFormat ( 'd/M/y H:i a', $sprintData->endDate );
    $sprintHashData ["id"] = $sprintData->sprint_id;
    $sprintHashData ["name"] = $sprintData->sprint_name;
    $sprintHashData ["status"] = $sprintData->sprint_status;
    $sprintHashData ["startDate"] = $startDate->format ( static::DATE_VALUE );
    $sprintHashData ["endDate"] = $endDate->format ( static::DATE_VALUE );
    $sprintHashData ["completeDate"] = $sprintData->completeDate;
    
    $sprintHash [$sprintData->sprint_id] = $sprintHashData;
   }
  }
  return $sprintHash;
 }
 
 /**
  * Get filter string with list of dates for a sprint.
  *
  *
  * @param
  *         array sprintHash
  * @param
  *         array sprintID
  *         
  * @return String range of sprint dates
  */
 public function sprint_giveAFilterStringForASprint($sprintHash, $sprintID) {
  $resultRange = $this->sprint_giveADateRangeOfASprint ( $sprintHash, $sprintID );
  $timeArray = $resultRange [$sprintID];
  
  if ($timeArray && is_array ( $timeArray ) && count ( $timeArray ) > 0) {
   $timeString = "";
   foreach ( $timeArray as $key => $value ) {
    // workaround for code smell - unused local variable
    echo str_replace ( $key, "", $key );
    $timeString = ($timeString !== "") ? $timeString . "," . $value : $value;
   }
   return 'IN (' . $timeString . ')';
  } else {
   return;
  }
 }
 
 /**
  * Get range of dates for a sprint.
  *
  *
  * @param
  *         array sprintHash
  * @param
  *         array sprintID
  *         
  * @return Array range of sprint dates
  */
 public function sprint_giveADateRangeOfASprint($sprintHash, $sprintID) {
  $sprintHashData = $sprintHash;
  if (array_key_exists ( $sprintID, $sprintHashData )) {
   $sprintDatesHash = $sprintHashData [$sprintID];
   $sprintStartDate = $sprintDatesHash ["startDate"];
   $sprintEndDate = $sprintDatesHash ["endDate"];
   $startDate = new DateTime ( $sprintStartDate );
   $endDate = new DateTime ( $sprintEndDate );
   $totalDaysDiff = $startDate->diff ( $endDate )->format ( "%a" );
   $range = $this->identifyDatesForDurationUnit ( "day", $totalDaysDiff, $sprintEndDate );
   if ($range === "INVALID") {
    return;
   }
   $sprintDateRange = $range;
   $resultHash = array ();
   $resultHash [$sprintID] = $sprintDateRange;
   
   return $resultHash;
  } else {
   return;
  }
 }
 
 /**
  * Get sprint details from jira sotred in CMDB.
  *
  * @return raw data from jira extracts
  */
 public function sprint_getSprintDetailsFromJiraCMDB() {
  list ( $jiraResourceID, $jiraProjectName, $rapidBoardID, $mvpVersion ) = $this->sprint_getJiraProjectNameFromResource ( "jira" );
  
  if ($jiraResourceID && $rapidBoardID) {
   $dataStoreForJiraSprints = "jira_sprints";
   $jiraSprintsDataStore = $rapidBoardID . "_" . $mvpVersion . "_" . $dataStoreForJiraSprints;
   $jiraSprintsDataExtract = "*";
   
   return $this->sprint_getJiraSprintsData ( $jiraResourceID, $jiraSprintsDataStore, $jiraSprintsDataExtract );
  } else {
   return;
  }
 }
 
 /**
  * Get extracts from provided resource.
  *
  *
  * @param
  *         String insightOrResourceID
  * @param
  *         String dataStoreName
  * @param
  *         String extractName
  *         
  * @return array extracts from jira
  */
 public function sprint_getJiraSprintsData($insightOrResourceID, $dataStoreName, $extractName) {
  $dataStoreID = $this->getInsightDataStoreID ( $insightOrResourceID, $dataStoreName );
  
  $paramHash = array ();
  $paramHash [static::FIELDS] = "data";
  $paramHash [static::FILTER] = array (
    'name' => $extractName 
  );
  
  return $this->getInsightDataStoreExtracts ( $insightOrResourceID, $dataStoreID, $paramHash, '' );
 }
 
 /**
  * Get extracts from provided resource.
  *
  *
  * @param
  *         String jiraResourceType
  *         
  * @return array extract details from jira
  */
 public function sprint_getJiraProjectNameFromResource($jiraResourceType) {
  $jiraResourceData = $this->getResources ( $jiraResourceType );
  if ($jiraResourceData && count ( $jiraResourceData ) > 0) {
   $jiraProjectName = isset($jiraResourceData[0]) && isset($jiraResourceData[0]->key_fields) && isset($jiraResourceData[0]->key_fields->jiraProject)  ? trim($jiraResourceData[0]->key_fields->jiraProject)  : '';
   $jiraProjectName = ($jiraProjectName === '') && isset($jiraResourceData[0]->key_fields) && isset($jiraResourceData[0]->key_fields->jiraProjectText)  ? trim($jiraResourceData[0]->key_fields->jiraProjectText)  : $jiraProjectName;
   $jiraResourceID  = $jiraResourceData[0]->id;
   $rapidBoardID    = isset($jiraResourceData[0]) && isset($jiraResourceData[0]->key_fields) && isset($jiraResourceData[0]->key_fields->rapidBoardId) ? trim($jiraResourceData[0]->key_fields->rapidBoardId) : '';
   $mvpVersion      = isset($jiraResourceData[0]) && isset($jiraResourceData[0]->key_fields) && isset($jiraResourceData[0]->key_fields->mvpVersion)   ? trim($jiraResourceData[0]->key_fields->mvpVersion)   : '';
   $mvpVersion      = ($mvpVersion === '') && isset($jiraResourceData[0]->key_fields) && isset($jiraResourceData[0]->key_fields->mvpVersionText)  ? trim($jiraResourceData[0]->key_fields->mvpVersionText)  : $mvpVersion;
   return array (
     $jiraResourceID,
     $jiraProjectName,
     $rapidBoardID,
     $mvpVersion 
   );
  } else {
   return;
  }
 }
 
 /**
  * Return the dates range based on the projection unit and count.
  * *
  * 
  * @param String $projectionUnit
  *         : Projection Unit in Days, Months or Weeks
  * @param
  *         String projectionCount : Projection Count of last data expected
  * @param
  *         String curr_date : Current date
  * @param
  *         boolean newStructure
  *         
  * @return array of dates
  */
 public function identifyDatesForDurationUnit($projectionUnit, $projectionCount, $curr_date = null, $newStructure = true) {
  $iCount = 0;
  $duration_arr = [ ];
  $curr_date = is_null ( $curr_date ) ? date ( static::DATE_VALUE ) : $curr_date;
  $oneDay = ' -1 day';
  
  switch ($projectionUnit) {
   case "day" :
    while ( $iCount < $projectionCount ) {
     $duration_arr [$iCount] = $curr_date;
     $curr_date = date ( static::DATE_VALUE, strtotime ( $oneDay, strtotime ( $curr_date ) ) );
     ++ $iCount;
    }
    break;
   case "week" :
    $projectionCount = $projectionCount * 7;
    while ( $iCount < $projectionCount ) {
     $duration_arr [$iCount] = $curr_date;
     $curr_date = date ( static::DATE_VALUE, strtotime ( $oneDay, strtotime ( $curr_date ) ) );
     ++ $iCount;
    }
    break;
   case "month" :
    $projectionCount = $newStructure ? $projectionCount : $projectionCount * 30;
    while ( $iCount < $projectionCount ) {
     $duration_arr [$iCount] = $curr_date;
     $curr_date = $newStructure ? date ( 'Y-m', strtotime ( ' -1 month', strtotime ( $curr_date ) ) ) : date ( static::DATE_VALUE, strtotime ( $oneDay, strtotime ( $curr_date ) ) );
     ++ $iCount;
    }
    break;
   case static::SPRINT :
    $duration_arr = $this->sprint_getDateRangeForAllSprints ();
    break;
   default :
    break;
  }
  if (is_array ( $duration_arr ) && $projectionUnit === static::SPRINT) {
   return $duration_arr;
  } elseif (is_array ( $duration_arr )) {
   return array_reverse ( $duration_arr );
  } else {
   return "INVALID";
  }
 }
 
 /**
  * Pull data from cloudmunch data base
  *
  * @param string $resourceID
  *         id of resource
  * @param array $dataStoreName
  *         data store name from which data needs to be pulled
  * @param array $filterFields
  *         comma seperated string fields to pass as filter in request
  * @param string $projectionUnit
  *         one of the following day,week,month,sprint
  * @param string $timeArray
  *         range of dates which will passed as filter
  * @return array data data recieved from data base
  *        
  */
 public function getExtractData($resourceID, $dataStoreName, $filterFields = "name,result", $projectionUnit = "day", $timeArray = null) {
  $this->logHelper->log ( "INFO", "Attempting data pull from cloudmunch data base ..." );
  $paramHash = array ();
  $paramHash [static::FIELDS] = $filterFields;
  $data = array ();
  $filter = static::FILTER;
  
  $dataStoreID = $this->getInsightDataStoreID ( $resourceID, $dataStoreName );
  
  if (! $dataStoreID) {
   $this->logHelper->log ( static::ERROR, "Unable to retrive data store id!" );
   return false;
  }
  
  // get data sprint wise
  if (! is_null ( $timeArray ) && is_array ( $timeArray ) && ($projectionUnit === static::SPRINT)) {
   foreach ( $timeArray as $sprint => $dateList ) {
    $sprintData = array ();
    $paramHash [$filter] = array (
      'name' => $dateList 
    );
    $sprintData = $this->getInsightDataStoreExtracts ( $resourceID, $dataStoreID, $paramHash, '' );
    if ($sprintData && is_array ( $sprintData ) && count ( $sprintData ) > 0) {
     $data [$sprint] = $sprintData;
    } else {
     $data [$sprint] = array ();
    }
   }
  } else {
   if (! is_null ( $timeArray ) && is_array ( $timeArray )) {
    $timeString = "";
    foreach ( $timeArray as $key => $value ) {
     // workaround for code smell - unused local variable
     echo str_replace ( $key, "", $key );
     $timeString = ($timeString !== "") ? $timeString . "," . $value : $value;
    }
    $paramHash [$filter] = array (
      'name' => 'IN (' . $timeString . ')' 
    );
   }
   $data = $this->getInsightDataStoreExtracts ( $resourceID, $dataStoreID, $paramHash, '' );
   if (! $data) {
    $this->logHelper->log ( static::ERROR, "Unable to retrieve extracts for date projection!" );
    return false;
   }
  }
  
  $this->logHelper->log ( "INFO", "Data recieved from CMDB" );
  
  return $data;
 }
 
 /**
  * Create report of type lintrend or kanban.
  *
  * @param
  *         string resourceID : id of resource
  * @param
  *         array dataFromCMDB : data to be passed for report creation
  * @param
  *         string reportName : name of report
  * @param
  *         string cardTitle : label to be displayed on card
  * @param
  *         string source : source of generated data
  * @param
  *         string description : description of report
  * @param
  *         string group : group to which this card belongs
  * @param
  *         string graphLegendsList : legends displayed in graph
  * @param
  *         string xAxisLabel : label displayed on x-axis
  * @param
  *         string yAxisLabel : label displayed on y-axis
  * @param
  *         string tolerance : tolerance info
  * @param
  *         string url : source url
  */
 public function createLineGraph($resourceID, $dataFromCMDB, $reportName, $cardTitle, $source, $description, $group, $graphLegendsList = null, $xAxisLabel = "Date", $yAxisLabel = "%", $tolerance = null, $url = "#") {
  $this->logHelper->log ( static::DEBUG, "Attempting creation of report - $reportName ..." );
  
  $dataOutput = array ();
  $data = array ();
  
  $visualizationMap = $this->linegraph_constructViewcardVisualizationMeta ( $graphLegendsList );
  $cardMeta = $this->linegraph_constructViewcardMeta ( $cardTitle, $source, $description, $group, $xAxisLabel, $yAxisLabel, $tolerance, $url, "line_default" );
  $dataOutput ["data"] = array ();
  $dataOutput ["data"] = $dataFromCMDB;
  
  $dataOutput ["card_meta"] = $cardMeta;
  $dataOutput ["visualization_map"] = $visualizationMap;
  $data ["data"] = $dataOutput;
  
  $reportID = $this->createInsightReport ( $resourceID, date ( static::DATE_VALUE ) );
  $cardID = $this->createInsightReportCard ( $resourceID, $reportID, $reportName );
  $this->updateInsightReportCard ( $resourceID, $reportID, $cardID, $data );
  $this->logHelper->log ( static::DEBUG, 'Report created!' );
  return $reportID;
 }
 
 /**
  * Create report of type lintrend or kanban.
  *
  * @param
  *         string resourceID : id of resource
  * @param
  *         array dataFromCMDB : data to be passed for report creation
  * @param
  *         string reportName : name of report
  * @param
  *         string cardTitle : label to be displayed on card
  * @param
  *         string source : source of generated data
  * @param
  *         string description : description of report
  * @param
  *         string group : group to which this card belongs
  * @param
  *         string graphLegendsList : legends displayed in graph
  * @param
  *         string xAxisLabel : label displayed on x-axis
  * @param
  *         string yAxisLabel : label displayed on y-axis
  * @param
  *         string tolerance : tolerance info
  * @param
  *         string url : source url
  */
 public function createBarGraph($resourceID, $dataFromCMDB, $reportName, $cardTitle, $source, $description, $group, $graphLegendsList = null, $xAxisLabel = "Date", $yAxisLabel = "%", $tolerance = null, $url = "#", $color = array()) {
  $this->logHelper->log ( static::DEBUG, "Attempting creation of report - $reportName ..." );
  
  $dataOutput = array ();
  $data = array ();
  
  $visualizationMap = $this->linegraph_constructViewcardVisualizationMeta ( $graphLegendsList, $color );
  $cardMeta = $this->linegraph_constructViewcardMeta ( $cardTitle, $source, $description, $group, $xAxisLabel, $yAxisLabel, $tolerance, $url, "bar_default" );
  $dataOutput ["data"] = array ();
  $dataOutput ["data"] = $dataFromCMDB;
  
  $dataOutput ["card_meta"] = $cardMeta;
  $dataOutput ["visualization_map"] = $visualizationMap;
  $data ["data"] = $dataOutput;
  
  $reportID = $this->createInsightReport ( $resourceID, date ( static::DATE_VALUE ) );
  $cardID = $this->createInsightReportCard ( $resourceID, $reportID, $reportName );
  $this->updateInsightReportCard ( $resourceID, $reportID, $cardID, $data );
  $this->logHelper->log ( static::DEBUG, 'Report created!' );
  return $reportID;
 }

 /**
  * Create report of type lintrend or kanban.
  *
  * @param
  *         string resourceID : id of resource
  * @param
  *         array dataFromCMDB : data to be passed for report creation
  * @param
  *         string reportName : name of report
  * @param
  *         string cardTitle : label to be displayed on card
  * @param
  *         string source : source of generated data
  * @param
  *         string description : description of report
  * @param
  *         string group : group to which this card belongs
  * @param
  *         string tolerance : tolerance info
  * @param
  *         string url : source url
  */
 public function createKanbanGraph($resourceID, $dataFromCMDB, $reportName, $cardTitle, $source, $description, $group, $tolerance = null, $url = "#") {
  $this->logHelper->log ( static::DEBUG, "Attempting creation of report - $reportName ..." );
  $dataOutput = array ();
  $data = array ();
  
  $visualizationMap = $this->kanban_constructViewcardVisualizationMeta ();
  $cardMeta = $this->kanban_constructViewcardMeta ( $cardTitle, $source, $description, $group, $tolerance, $url );
  $dataOutput ["data"] = array ();
  $dataOutput ["data"] = array (
    $dataFromCMDB 
  );
  
  $dataOutput ["card_meta"] = $cardMeta;
  $dataOutput ["visualization_map"] = $visualizationMap;
  $data ["data"] = $dataOutput;
  
  $reportID = $this->createInsightReport ( $resourceID, date ( static::DATE_VALUE ) );
  $cardID = $this->createInsightReportCard ( $resourceID, $reportID, $reportName );
  $this->updateInsightReportCard ( $resourceID, $reportID, $cardID, $data );
  $this->logHelper->log ( static::DEBUG, 'Report created!' );
  return $reportID;
 }
 
 /**
  * Contruct Viewcard visualization meta data.
  *
  * @param
  *         array graphLegendsList : List of graphs legend
  *         
  * @return array with visualization map
  */
 public function linegraph_constructViewcardVisualizationMeta($graphLegendsList, $color = array()) {
  $data = array (
            "plots" => array (
              "x" => array (
                static::LABEL 
              ),
              "y" => $graphLegendsList
            )
          );
  if ($color && is_array($color)) {
      $data['color'] = $color;
  }
  return $data;
 }
 
 /**
  * Construct view card meta data.
  *
  * @param
  *         string cardTitle : label to be displayed on card
  * @param
  *         string source : source of generated data
  * @param
  *         string description : description of report
  * @param
  *         string group : group to which this card belongs
  * @param
  *         string xAxisLabel : label displayed on x-axis
  * @param
  *         string yAxisLabel : label displayed on y-axis
  * @param
  *         string tolerance : tolerance info
  * @param
  *         string url : source url
  * @return array with Card meta data
  */
 public function linegraph_constructViewcardMeta($cardTitle, $source, $description, $group, $xAxisLabel = "Date", $yAxisLabel = "%", $tolerance = null, $url = "#", $type = "line_default") {
  $cardMeta = array (
    "default" => $type,
    "url" => $url,
    "date" => date ( "Y-m-d H:i:s" ),
    static::LABEL => ucfirst ( $cardTitle ),
    "source" => $source,
    "group" => $group,
    "description" => $description,
    "visualization_options" => array (
      $type 
    ),
    "xaxis" => array (
      static::LABEL => $xAxisLabel 
    ),
    "yaxis" => array (
      static::LABEL => $yAxisLabel 
    ) 
  );
  
  $isToleranceSet = (isset ( $tolerance ) && is_array ( $tolerance ) && count ( $tolerance ) > 0);
  
  if ($isToleranceSet) {
   $cardMeta [static::TOLERANCE_STATE] = ($isToleranceSet && $tolerance [static::TOLERANCE_STATE]) ? $tolerance [static::TOLERANCE_STATE] : '';
   $cardMeta [static::TOLERANCE_DESCRIPTION] = ($isToleranceSet && $tolerance [static::TOLERANCE_DESCRIPTION]) ? $tolerance [static::TOLERANCE_DESCRIPTION] : '';
   $cardMeta [static::TOLERANCE_HIT] = ($isToleranceSet && $tolerance [static::TOLERANCE_HIT]) ? $tolerance [static::TOLERANCE_HIT] : '';
  }
  
  return $cardMeta;
 }
 
 /**
  * Construct view card meta data
  *
  * @param
  *         string cardTitle : label to be displayed on card
  * @param
  *         string source : source of generated data
  * @param
  *         string description : description of report
  * @param
  *         string group : group to which this card belongs
  * @param
  *         string tolerance : tolerance info
  * @param
  *         string url : source url
  * @return array with Card meta data
  */
 public function kanban_constructViewcardMeta($cardTitle, $source, $description, $group, $tolerance = null, $url = "#") {
  $cardMeta = array (
    "default" => static::KANBAN,
    "url" => $url,
    "date" => date ( 'Y-m-d H:i:s' ),
    static::LABEL => ucfirst ( $cardTitle ),
    "source" => $source,
    "group" => $group,
    "description" => $description,
    "visualization_options" => array (
      static::KANBAN 
    ) 
  );
  
  $isToleranceSet = (isset ( $tolerance ) && is_array ( $tolerance ) && count ( $tolerance ) > 0);
  
  if ($isToleranceSet) {
   $cardMeta [static::TOLERANCE_STATE] = ($isToleranceSet && $tolerance [static::TOLERANCE_STATE]) ? $tolerance [static::TOLERANCE_STATE] : '';
   $cardMeta [static::TOLERANCE_DESCRIPTION] = ($isToleranceSet && $tolerance [static::TOLERANCE_DESCRIPTION]) ? $tolerance [static::TOLERANCE_DESCRIPTION] : '';
   $cardMeta [static::TOLERANCE_HIT] = ($isToleranceSet && $tolerance [static::TOLERANCE_HIT]) ? $tolerance [static::TOLERANCE_HIT] : '';
  }
  
  return $cardMeta;
 }
 
 /**
  * Contruct Viewcard visualization meta data
  *
  * @return array with visualization map
  */
 public function kanban_constructViewcardVisualizationMeta() {
  return array (
    "cards" => array (
      "type" => static::KANBAN 
    ) 
  );
 }
 
 /**
  * Store passed data in data store
  *
  * @param
  *         string resourceID : id of resource
  * @param
  *         array data : data to be stored in database
  * @param
  *         string dataStoreName : name of data store
  * @param
  *         string extractName : name of extract
  * @param
  *         string additionInfo : additional info on source
  */
 public function updateExtract($resourceID, $data, $dataStoreName, $extractName = null, $additionInfo = null, $dataNode = "result") {
  $extractName = (is_null ( $extractName ) || empty ( $extractName )) ? date ( static::DATE_VALUE ) : $extractName;
  if ($resourceID && $data && $dataStoreName) {
   $this->logHelper->log ( static::DEBUG, "Attempting Creation of Data Store $dataStoreName ..." );
   $dataStoreID = $this->createInsightDataStore ( $resourceID, $dataStoreName );
   if (! $dataStoreID) {
    $this->logHelper->log ( static::ERROR, "Unable to create datastore!" );
    return false;
   }
   $this->logHelper->log ( static::DEBUG, "DataStore created!" );
   
   $arrData = [ ];
   $arrData [$dataNode] = $data;
   $arrData [additional_info] = $additionInfo;
   $response = $this->createInsightDataStoreExtract ( $resourceID, $dataStoreID, $extractName, $arrData );
   if ($response) {
    $this->logHelper->log ( static::DEBUG, "DataStore extract updated!" );
    return $dataStoreID;
   }
  } else {
   $this->logHelper->log ( static::ERROR, "Resource id, data and datastore name has to be passed to update an extract" );
   return false;
  }
 }
 
 /**
  * Store passed data in data store
  *
  * @param
  *         string resourceID : id of resource
  * @param
  *         array data : data to be stored in database
  * @param
  *         string dataStoreName : name of data store
  * @param
  *         string extractName : name of extract
  * @param
  *         string additionalInfo : additional info of source. An object with two nodes, source_name : <repo name> and source_url : <web url which can be used to view source from browser>
  * @param
  *         string dataNode : parent node name of data to be stored in extract
  * @return boolean true or false based or success
  */
  public function optimizedUpdateExtract($resourceID, $data, $dataStoreName, $extractName , $additionalInfo = null, $dataNode = "result", $dataStoreID = null) {
    if ($dataStoreID){
        $arrData = [];
        $arrData[$dataNode] = $data;
        $arrData[additional_info] = $additionalInfo;
        $response  = $this->createInsightDataStoreExtract($resourceID, $dataStoreID, $extractName, $arrData);
        $response  = $response  ? $response : $this->logHelper->log(static::DEBUG, "Unable to update extract");
        return $response ? true : false;
    } else {
        $dataStoreID = $this->updateExtract($resourceID, $data, $dataStoreName, $extractName, $additionalInfo, $dataNode);
        return $dataStoreID ? true : false;
    }  
  }

 /**
  * Create report of type doughnut.
  *
  * @param
  *         string resourceID : id of resource
  * @param
  *         array data : data to be passed for report creation
  * @param
  *         string reportName : name of report
  * @param
  *         string cardLabel : label to be displayed on card
  * @param
  *         string sourceName : source of generated data
  * @param
  *         string description : description of report
  * @param
  *         string group : group to which this card belongs
  * @param
  *         string sourceURL : source url
  * @param
  *         string legendsList : legends displayed in graph
  */
 public function createDoughnutGraph($resourceID, $data, $reportName, $cardLabel, $sourceName, $description, $group, $sourceURL, $legendsList) {
  $reportID = null;
  if ($data && is_array ( $data ) && count ( $data )) {
   $cardMetaInfo = array (
     "default" => "doughnut",
     "url" => $sourceURL,
     "date" => date ( "Y-m-d H:i:s" ),
     "label" => $cardLabel,
     "source" => $sourceName,
     "group" => $group,
     "description" => $description,
     "visualization_options" => array (
       "doughnut" 
     ),
     "xaxis" => ( object ) array (
       "label" => "" 
     ),
     "yaxis" => ( object ) array (
       "label" => "" 
     ) 
   );
   
   $final ['data'] = array (
     $data 
   );
   $final ['visualization_map'] = ( object ) array (
     "plots" => ( object ) array (
       "sections" => $legendsList 
     ),
     "x" => "140",
     "y" => "120" 
   );
   $final ['card_meta'] = $cardMetaInfo;
   $data = array ();
   $data ["data"] = $final;
   $reportID = $this->createInsightReport ( $resourceID, date ( "Y-m-d" ) );
   $cardID = $this->createInsightReportCard ( $resourceID, $reportID, $reportName );
   $response = $this->updateInsightReportCard ( $resourceID, $reportID, $cardID, $data );
   if ($response) {
    $this->logHelper->log ( static::DEBUG, "Report created!" );
   }
  }
  return $reportID;
 }
 
 /**
  * Adds key metrics data to report
  *
  * @param
  *         string resourceID : id of resource
  * @param
  *         string reportID : id of report
  * @param
  *         array metricID : id of metric
  * @param
  *         string name : name to be displayed on card
  * @param
  *         string value : value to be displayed on card
  * @param
  *         string valueType : percentage is supported now
  * @param
  *         string source : source from data
  * @param
  *         string sourceURL : source url
  * @param
  *         string subText : subtext to be displayed below value
  * @param
  *         string color : color of card
  *         
  */
 public function addKeyMetric($resourceID, $reportID, $metricId, $name, $value, $valueType = null, $source = null, $sourceURL = null, $subtext = '', $color = "#009900") {
  if ($value && $metricId && $name && $reportID && $resourceID) {
   $id = $resourceID . "_" . $id;
   $temp [$id] = array ();
   
   $temp [$id] ["metric"] = ucfirst ( $name );
   $temp [$id] ["id"] = $id;
   $temp [$id] ['sub_text'] = $subtext ? $subtext : '';
   $temp [$id] ["source_url"] = $sourceURL;
   $temp [$id] ["source_name"] = $source;
   $temp [$id] ["card_color"] = $color;
   $temp [$id] ["description"] = $description;
   $temp [$id] ["insight_id"] = $resourceID;
   $temp [$id] ["value"] = $value;
   $temp [$id] ["value_type"] = $valueType;
   $temp [$id] ["insight_report_id"] = $reportID;
   $temp [$id] ["application_id"] = $this->appContext->getProject ();
   $temp [$id] ["date"] = gmdate ( "Y-m-d\TH:i:s\Z" );
   $metrics ["key_metrics"] = $temp;
   
   return $this->updateInsightReport ( $resourceID, $reportID, $metrics );
  } else {
   $this->logHelper->log ( static::ERROR, "Resource id, value, metric id, name, and report id has to be passed to create a key metric" );
   return false;
  }
 }
 
 /**
  * Compare and set tolerance status based on percentage change in value of latest element with its previous element against provided upper and lower limit.
  * Status takes precedence in the following order, Failed > Warning > success
  *
  * @param
  *         array data : data constructed for trend graph
  * @param
  *         integer upperLimit : upper limit for change
  * @param
  *         integer lowerLimit : lower limit for change
  * @param
  *         integer resourceName
  * @param
  *         integer cardLabel
  * @param
  *         integer source
  * @return array tolerance : toleranceState (success, failure, warning, critical)
  *         : toleranceDescription
  *         : toleranceHit
  */
 function checkToleranceForTrend($data, $upperLimit, $lowerLimit, $resourceName = null, $cardLabel = null, $source = null) {
  $elements = count ( $data );
  $upperLimit = intval ( $upperLimit );
  $lowerLimit = intval ( $lowerLimit );
  $tolerance = array ();
  // Need a minimum of 2 elements to compare
  if ($elements > 1) {
   $latest = $elements - 1;
   $previous = $latest - 1;
   $toleranceFailed = false;
   $toleranceWarning = false;
   $tolerance [static::TOLERANCE_DESCRIPTION] = '';
   if ($resourceName && $cardLabel) {
    $tolerance [static::TOLERANCE_DESCRIPTION] = $source ? "**Highlights for Resource: " . $resourceName . ", Context: " . $source . " and Report: " . $cardLabel . "**\n\n  " : "**Highlights for Resource: " . $resourceName . " and Report: " . $cardLabel . "**\n\n  ";
   }
   foreach ( $data [$latest] as $key => $value ) {
    $data [$previous] = is_array ( $data [$previous] ) ? ( object ) $data [$previous] : $data [$previous];
    if (strtolower ( $key ) !== static::LABEL && $data [$previous] && $data [$previous]->$key && floatval ( $data [$previous]->$key ) !== 0) {
     
     // % change = ( abs (originalValue - newValue) / originalValue ) * 100
     $change = number_format ( (abs ( floatval ( $value ) - floatval ( $data [$previous]->$key ) ) / floatval ( $data [$previous]->$key )) * 100 );
     
     if ($change > $upperLimit) {
      $toleranceFailed = true;
      $toleranceMsg = "- There seems to be a significant change (> " . $upperLimit . ") in $key when compared to previous value, probably needs some intervention.";
      $tolerance [static::TOLERANCE_STATE] = 'critical';
      $tolerance [static::TOLERANCE_HIT] = isset ( $tolerance [static::TOLERANCE_HIT] ) ? $tolerance [static::TOLERANCE_HIT] . " " . $toleranceMsg : $toleranceMsg;
     } elseif (($change <= $upperLimit) && ($change >= $lowerLimit)) {
      $toleranceWarning = true;
      $toleranceMsg = "- The change in $key when compared to previous value is trending towards critical (" . $upperLimit . ").";
      $tolerance [static::TOLERANCE_HIT] = isset ( $tolerance [static::TOLERANCE_HIT] ) ? $tolerance [static::TOLERANCE_HIT] . " " . $toleranceMsg : $toleranceMsg;
      $tolerance [static::TOLERANCE_STATE] = ! $toleranceFailed ? "warning" : $tolerance [static::TOLERANCE_STATE];
     } elseif ($change < intval ( $upperLimit )) {
      $tolerance [static::TOLERANCE_STATE] = (! $toleranceFailed && ! $toleranceWarning) ? "success" : $tolerance [static::TOLERANCE_STATE];
     }
    }
   }
   if ($toleranceFailed || $toleranceWarning) {
    $tolerance [static::TOLERANCE_DESCRIPTION] .= "\n" . $tolerance [static::TOLERANCE_HIT];
   } elseif ($tolerance [static::TOLERANCE_STATE] === 'success') {
    $tolerance [static::TOLERANCE_DESCRIPTION] .= "- All parameters are trending within an acceptable range.";
   } else {
    $tolerance [static::TOLERANCE_DESCRIPTION] .= "Tolerance was not configured or previous value is either 0 or non-existent.";
   }
   return $tolerance;
  } else {
   $tolerance [static::TOLERANCE_DESCRIPTION] = "Tolerance was not configured or previous value is either 0 or non-existent.";
   return $tolerance;
  }
 }
}
?>
