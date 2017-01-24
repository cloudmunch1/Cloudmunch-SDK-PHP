<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi Chandy rosmi@cloudmunch.com
 */
namespace CloudMunch;

use CloudMunch\datamanager\CMDataManager;
use CloudMunch\AppContext;
use CloudMunch\loghandling\LogHandler;

/**
 * Class CloudmunchService
 * This class provides the service methods for the plugins to make various API calls  to  cloudmunch.
 * @package CloudMunch
 * @author Rosmi
 * 
 */
class CloudmunchService {
 const APPLICATIONS = "/applications/";
 /**
  * 
  * @var Reference to AppContext
  */
 private $appContext = null; 

 /**
  * 
  * @var Reference to CMDataManager 
  */
 private $cmDataManager;
 
 /**
  * 
  * @var List of downloaded keys
  */
 private $keyArray = array ();
 
 /**
  * 
  * @var Reference to LogHelper
  */
 private $logHelper = null;
 
 /**
  * Constructor to initialise Application Context and LogHandler.
  * @param CloudMunch\AppContext $appContext
  * @param CloudMunch\loghandling\LogHandler $logHandler
  */
 public function __construct($appContext, $logHandler) {
  $this->appContext = $appContext;
  $this->logHelper = $logHandler;
  $this->cmDataManager = new CMDataManager ( $this->logHelper, $this->appContext );
 }
 /**
  * This method is to send notification on a selected channel.
  *
  * @param string $message
  *         : Notification message.
  * @param string $channel
  *         : Channel to send notification to
  * @param string $to
  *         : To addresses to be notified
  * @param string $subject
  *         - optional
  *         : Subject of the notification (incase of mail)
  * @param string $attachment
  *         - optional
  *         : Attachment of the notification
  */
 public function sendNotification($message, $channel, $to, $subject = "", $attachment = "") {
  if (empty ( $message ) || empty ( $channel ) || empty ( $to )) {
   $this->logHelper->log ( ERROR, "Message, channel and a to list is mandatory to send a notification" );
   return false;
  }
  $dataarray = array (
    "body" => $message,
    "channel" => $channel,
    "to" => $to,
    "subject" => $subject,
    "attachment" => $attachment 
  );
  return $this->cmDataManager->sendNotification ( $this->appContext->getMasterURL (), $this->appContext->getAPIKey (), $dataarray );
 }
 
 /**
  * This method is used to update data for a particular context.
  * 
  * @param array $contextArray
  *         associative array with key as context and value as its id.
  * @param array $data
  *         Data to be updated.
  * @param string $method
  *         method for updation, example POST,PATCH.
  * @param array $extraParams
  *        Extra parameters 
  *                
  * @return 
  *
  */
 public function updateCustomContextData($contextArray, $data = null, $method = "PATCH", $extraParams = null) {
  if (is_null ( $data )) {
   $this->logHelper->log ( ERROR, "Data needs to be provided to update a context" );
   return false;
  }
  
  if (is_array ( $contextArray ) && count ( $contextArray ) > 0) {
   $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject ();
   
   foreach ( $contextArray as $key => $value ) {
    if (! is_null ( $value ) && ! empty ( $value )) {
     $serverurl = $serverurl . "/" . $key . "/" . $value;
    } else {
     $serverurl = $serverurl . "/" . $key;
     break;
    }
   }
  } else {
   $this->logHelper->log ( ERROR, "First parameter is expected to be an array with key value pairs" );
   return false;
  }
  
  if ($method === "POST") {
   $retArray = $this->cmDataManager->putDataForContext ( $serverurl, $this->appContext->getAPIKey (), $data, null, $extraParams );
  } else {
   $retArray = $this->cmDataManager->updateDataForContext ( $serverurl, $this->appContext->getAPIKey (), $data );
  }
  
  if ($retArray === false) {
   return false;
  }
  
  return $retArray->data;
 }

/**
  * Executor an interface action and return the response.
  *
  * @param string integrationID : id of integration
  * @param string action        : action to be executed
  * @param string data          : any data to be passed to interface
  *         
  * @return json response from api interface action
  */
  public function callInterfaceAction($integrationID, $action, $data = array()){
    if ($integrationID && $action){
      return $this->updateCustomContextData(array('integrations' => $integrationID), $data, "POST", array('action' => $action) );
    } else {
     $this->logHelper->log ( ERROR, "Integration id and an action is mandatory to execute an action" );
      return false;
    }
  }
 
 /**
  * Retreive custom context data.
  * @param array $contextArray
  *         associative array with key as context and its id as value
  * @param array $queryParams
  *         query paramters
  * @return array data
  */
 public function getCustomContextData($contextArray, $queryParams) {
  $querystring = "";
  
  if (is_array ( $contextArray ) && count ( $contextArray ) > 0) {
   $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject ();
   
   foreach ( $contextArray as $key => $value ) {
    if (! is_null ( $value ) && ! empty ( $value )) {
     $serverurl = $serverurl . "/" . $key . "/" . $value;
    } else {
     $serverurl = $serverurl . "/" . $key;
     break;
    }
   }
   
   if (is_array ( $queryParams ) && (count ( $queryParams ) > 0)) {
    
    foreach ( $queryParams as $key => $value ) {
     if ($key === "filter") {
      $value = urlencode ( json_encode ( $value ) );
     }
     
     if ($querystring !== "") {
      $querystring = $key . "=" . $value . "&" . $querystring;
     } else {
      $querystring = $key . "=" . $value;
     }
    }
   }
  } else {
   $this->logHelper->log ( ERROR, "First parameter is expected to be an array with key value pairs" );
   return false;
  }
  
  $dataArray = $this->cmDataManager->getDataForContext ( $serverurl, $this->appContext->getAPIKey (), $querystring );
  
  if (is_bool ( $dataArray ) && ! $dataArray) {
   $this->logHelper->log ( ERROR, "Could not retreive data from cloudmunch" );
   return false;
  }
  
  return $dataArray->data;
 }
 
 /**
  * Method for API calls to CloudMunch service to retreive context data.
  * @param string $context
  *         Context for which data has to be retrieved.
  * @param string $contextid
  *         ID of the context.
  * @param array $filterdata
  *         Filter data
  * @return array data
  */
 public function getCloudmunchData($context, $contextid, $filterdata) {
  $querystring = "";
  if ($filterdata !== null) {
   $querystring = "filter=" . json_encode ( $filterdata );
  }
  $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/" . $contextid;
  
  $dataArray = $this->cmDataManager->getDataForContext ( $serverurl, $this->appContext->getAPIKey (), $querystring );
  if (is_bool ( $dataArray ) && ! $dataArray) {
   $this->logHelper->log ( ERROR, "Could not retreive data from cloudmunch" );
   return false;
  }
  
  $data = $dataArray->data;
  if ($data == null) {
   $this->logHelper->log ( ERROR, "Data does not exist" );
   return false;
  }
  return $data;
 }
 
 /**
  * Method for API calls to CloudMunch service to update context data.
  * @param string $context
  *         Context for which data has to be updated.
  * @param string $contextid
  *         ID of the context.
  * @param array $data
  *         Data to be updated
  * @return array data
  */
 public function updateCloudmunchData($context, $contextid, $data) {
  $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/";
  if (empty ( $contextid )) {
   $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/";
  } else {
   $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/" . $contextid;
  }
  $retArray = $this->cmDataManager->updateDataForContext ( $serverurl, $this->appContext->getAPIKey (), $data );
  
  if ($retArray === false) {
   return false;
  }
  
  return $retArray->data;
 }
 
 /**
  * Method for API calls to CloudMunch service to add context data.
  * @param string $context
  *         Context for which data has to be added.
  * @param array $data
  *         Data to be updated
  * @return array data
  */
 public function addCloudmunchData($context, $data) {
  $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/";
  
  $retArray = $this->cmDataManager->putDataForContext ( $serverurl, $this->appContext->getAPIKey (), $data );
  
  if ($retArray === false) {
   return false;
  }
  
  return $retArray->data;
 }
 
 /**
  * This method deletes the context data of the object with given ID.
  * 
  * @param string $context
  *         Context for which data has to be deleted.
  * @param string $contextid
  *         ID of the context.
  */
 public function deleteCloudmunchData($context, $contextid) {
  $serverurl = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/" . $contextid;
  $result = $this->cmDataManager->deleteDataForContext ( $serverurl, $this->appContext->getAPIKey () );
  if ($result === false) {
   return false;
  }
  return $result;
 }
 
 /**
  * This method downloads Google container registry key.
  * 
  * @param string $filekey
  *         name of the key field
  * @param string $context
  *         context of the key
  * @param string $contextid
  *         id of the context
  * @return string location of the downloaded file
  */
 public function downloadGCRKeys($filekey, $context, $contextid) {
  $url = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/" . $contextid;
  $querystring = "file=" . $filekey;
  
  $keyString = $this->cmDataManager->downloadGSkey ( $url, $this->appContext->getAPIKey (), $querystring );
  
  if ($keyString === false) {
   return false;
  }
  
  if (empty ( $keyString ) || ! (strlen ( $keyString ) > 0)) {
   $this->logHelper->log ( ERROR, "downloaded key content is empty, please re-upload key and try" );
   return false;
  }
  
  $filename = "keyfile" . rand ();
  $this->appContext->getWorkSpaceLocation ();
  
  $file = $this->appContext->getWorkSpaceLocation () . "/" . $filename;
  file_put_contents ( $file, $keyString );
  system ( 'chmod 400 ' . $file, $retval );
  array_push ( $this->keyArray, $file );
  return $file;
 }
 
 /**
  * This method downloads key files from cloudmunch.
  * 
  * @param string $filekey
  *         name of the key field
  * @param string $context
  *         context of the key
  * @param string $contextid
  *         id of the context
  * @return string location of the downloaded file
  */
 public function downloadKeys($filekey, $context, $contextid) {
  $url = $this->appContext->getMasterURL () . static::APPLICATIONS . $this->appContext->getProject () . "/" . $context . "/" . $contextid;
  $querystring = "file=" . $filekey;
  
  $keyString = $this->cmDataManager->getDataForContext ( $url, $this->appContext->getAPIKey (), $querystring );
  if (! is_string ( $keyString )) {
   $keyString = json_encode ( $keyString );
  }
  if ($keyString === false || $keyString === "false") {
   return false;
  }
  
  if (empty ( $keyString ) || ! (strlen ( $keyString ) > 0)) {
   $this->logHelper->log ( ERROR, "downloaded key content is empty, please re-upload key and try" );
   return false;
  }
  
  $filename = "keyfile" . rand ();
  $this->appContext->getWorkSpaceLocation ();
  
  $file = $this->appContext->getWorkSpaceLocation () . "/" . $filename;
  file_put_contents ( $file, $keyString );
  system ( 'chmod 400 ' . $file, $retval );
  array_push ( $this->keyArray, $file );
  return $file;
 }
 
 /**
  * This method is invoked on app completion to delete the downloaded keys
  */
 public function deleteKeys() {
  foreach ( $this->keyArray as $file ) {
   if (file_exists ( $file )) {
                system ( "rm " . $file );
            }
        }
    }
}
?>
