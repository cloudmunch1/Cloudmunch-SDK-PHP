<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 */
namespace CloudMunch\helper;

use \DateTime;
use CloudMunch\helper\InsightHelper;
use CloudMunch\AppContext;
use CloudMunch\loghandling\LogHandler;

/**
 * This is a helper to create extracts with common structure. These extracts can be used by common reporters. 
 *
 * @package CloudMunch
 * @author Amith Kumar <amith@cloudmunch.com>
 */
class CIMHelper {
 const DEBUG = 'DEBUG';
 const ERROR = 'ERROR';

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
    $this->logHelper  = $logHandler;
    $this->insightHelper = new InsightHelper ( $appContext, $this->logHelper );
  }
 
 /**
  * Create an extract with commit details.
  *
  * @param string $resourceID
  *         id of resource.
  * @param string $commitID
  *         id of commitID.
  * @param array $commitInfo
  *         info on a commit.
  * @param string $additionalInfo
  *         additional info of source. An object with two nodes, source_name : <repo name> and source_url : <web url which can be used to view source from browser>
  * @param string $dataStoreID
  *         id of datastore. This can be passed to reduce number of calls to cloudmunch database
  *         
  * @return boolean true or false based on success or failure
  */
  public function createCommit($resourceID, $commitInfo, $commitID,  $additionalInfo = null, $dataStoreID = null){
    $mandatoryFields = ["files", "commit_message", "author", "email", "date"];
    list($fieldsAvailble, $missingFields) = $this->validateFields($commitInfo, $mandatoryFields);
    if (!$fieldsAvailble) {
      $this->logHelper->log(static::ERROR, $missingFields);
      return false;
    }
    return $this->insightHelper->optimizedUpdateExtract($resourceID, $commitInfo, "Commits", $commitID, $additionalInfo, "commit", $dataStoreID);
  }

 /**
  * Create an extract with story details.
  *
  * @param string $resourceID
  *         id of resource.
  * @param string $storyID
  *         id of storyID.
  * @param array $storyInfo
  *         info on a story.
  * @param string $additionalInfo
  *         additional info of source. An object with two nodes, source_name : <repo name> and source_url : <web url which can be used to view source from browser>
  * @param string $dataStoreID
  *         id of datastore. This can be passed to reduce number of calls to cloudmunch database
  *         
  * @return boolean true or false based on success or failure
  */
  public function createStory($resourceID, $storyInfo, $storyID,  $additionalInfo = null, $dataStoreID = null){
    $mandatoryFields = ["type", "story_status", "story_points"];
    list($fieldsAvailble, $missingFields) = $this->validateFields($storyInfo, $mandatoryFields);
    if (!$fieldsAvailble) {
      $this->logHelper->log(static::ERROR, $missingFields);
      return false;
    }
    return $this->insightHelper->optimizedUpdateExtract($resourceID, $storyInfo, "Stories", $storyID, $additionalInfo, "story", $dataStoreID);
  }

 /**
  * Create an extract with defect details.
  *
  * @param string $resourceID
  *         id of resource.
  * @param string $defectID
  *         id of defectID.
  * @param array $defectInfo
  *         info on a commit.
  * @param string $additionalInfo
  *         additional info of source. An object with two nodes, source_name : <repo name> and source_url : <web url which can be used to view source from browser>
  * @param string $dataStoreID
  *         id of datastore. This can be passed to reduce number of calls to cloudmunch database
  *         
  * @return boolean true or false based on success or failure
  */
  public function createDefect($resourceID, $defectInfo, $defectID,  $additionalInfo = null, $dataStoreID = null){
    $mandatoryFields = ["type", "defect_criticality", "defect_status", "story_points"];
    list($fieldsAvailble, $missingFields) = $this->validateFields($defectInfo, $mandatoryFields);
    if (!$fieldsAvailble) {
      $this->logHelper->log(static::ERROR, $missingFields);
      return false;
    }
    return $this->insightHelper->optimizedUpdateExtract($resourceID, $defectInfo, "Defects", $defectID, $additionalInfo, "defect", $dataStoreID);
  }

 /**
  * Create an extract with risk details.
  *
  * @param string $resourceID
  *         id of resource.
  * @param string $riskID
  *         id of riskID.
  * @param array $riskInfo
  *         info on a risk.
  * @param string $additionalInfo
  *         additional info of source. An object with two nodes, source_name : <repo name> and source_url : <web url which can be used to view source from browser>
  * @param string $dataStoreID
  *         id of datastore. This can be passed to reduce number of calls to cloudmunch database
  *         
  * @return boolean true or false based on success or failure
  */
  public function createRisk($resourceID, $riskInfo, $riskID,  $additionalInfo = null, $dataStoreID = null){
    $mandatoryFields = ["type", "severity", "risk_status"];
    list($fieldsAvailble, $missingFields) = $this->validateFields($riskInfo, $mandatoryFields);
    if (!$fieldsAvailble) {
      $this->logHelper->log(static::ERROR, $missingFields);
      return false;
    }
    return $this->insightHelper->optimizedUpdateExtract($resourceID, $riskInfo, "Risks", $riskID, $additionalInfo, "risk", $dataStoreID);
  }

 /**
  * Create an extract with sprint details.
  *
  * @param string $resourceID
  *         id of resource.
  * @param string $sprintID
  *         id of sprintID.
  * @param array $sprintInfo
  *         info on a sprint.
  * @param string $additionalInfo
  *         additional info of source. An object with two nodes, source_name : <repo name> and source_url : <web url which can be used to view source from browser>
  * @param string $dataStoreID
  *         id of datastore. This can be passed to reduce number of calls to cloudmunch database
  *         
  * @return boolean true or false based on success or failure
  */
  public function createSprint($resourceID, $sprintInfo, $sprintID,  $additionalInfo = null, $dataStoreID = null){
    $mandatoryFields = ["type", "sprint_iD", "sprint_name", "sequence", "sprint_status", "startDate", "endDate"];
    list($fieldsAvailble, $missingFields) = $this->validateFields($sprintInfo, $mandatoryFields);
    if (!$fieldsAvailble) {
      $this->logHelper->log(static::ERROR, $missingFields);
      return false;
    }
    return $this->insightHelper->optimizedUpdateExtract($resourceID, $sprintInfo, "Sprints", $sprintID, $additionalInfo, "sprint", $dataStoreID);
  }

 /**
  * Create an extract with build details.
  *
  * @param string $resourceID
  *         id of resource.
  * @param string $buildID
  *         id of buildID.
  * @param array $buildInfo
  *         info on a build.
  * @param string $additionalInfo
  *         additional info of source. An object with two nodes, source_name : <repo name> and source_url : <web url which can be used to view source from browser>
  * @param string $dataStoreID
  *         id of datastore. This can be passed to reduce number of calls to cloudmunch database
  *         
  * @return boolean true or false based on success or failure
  */
  public function createBuild($resourceID, $buildInfo, $buildID,  $additionalInfo = null, $dataStoreID = null){
    $mandatoryFields = ["id", "displayName", "duration", "estimatedDuration", "result"];
    list($fieldsAvailble, $missingFields) = $this->validateFields($buildInfo, $mandatoryFields);
    if (!$fieldsAvailble) {
      $this->logHelper->log(static::ERROR, $missingFields);
      return false;
    }
    return $this->insightHelper->optimizedUpdateExtract($resourceID, $buildInfo, "Builds", $buildID, $additionalInfo, "build", $dataStoreID);
  }

 /**
  * Check if given fields are part of provided data.
  *
  * @param array $data
  *         data to be parsed.
  * @param array $fields
  *         List of mandatory fields.
  *         
  * @return array  boolean  true or false based on availability
  *                string   missing fields list
  */
  public function validateFields($data, $fields){
    if ($data && is_object($data)){
      $tmp  = json_encode($data);
      $data = json_decode($tmp, true);
    }

    $data   = $data   && is_array($data)    ? $data   : null;
    $fields = $fields && is_array($fields)  ? $fields : null;

    if (!($data && $fields)) {
      return array(false, "Data is empty!");
    }

    $isValid = false;
    $missingFields = "";
    foreach ($fields as $key => $value) {
      if (!isset($data[$value])) {
        $missingFields = strlen($missingFields) < 1 ? "Missing field list : " . $value : $missingFields . " ," . $value;
      }
    }

    if (strlen($missingFields) > 0) {
      return array(false, $missingFields);
    } else {
      return array(true, $missingFields);
    }
  }
}
?>
