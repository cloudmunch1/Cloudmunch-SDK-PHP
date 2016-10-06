<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi Chandy rosmi@cloudmunch.com
 */
namespace CloudMunch\datamanager;

use CloudMunch\helper\NotificationHandler;
use CloudMunch\AppContext;
use CloudMunch\loghandling\LogHandler;

/**
 * Class CMDataManager
 * This class connects to cloudmunch to update /retrieve data
 */
class CMDataManager {
 const RESPONSE = "response";
 const SUCCESS = "SUCCESS";
 const REQUESTID = "Request ID";
 const APIKEY = "?apikey=";
 
 /**
  *
  * @var CloudMunch\loghandling\LogHandler Reference to LogHandler object.
  */
 private $logHelper = null;
 
 /**
  *
  * @var CloudMunch\AppContext Reference to AppContext object.
  */
 private $appContext = null;
 
 /**
  *
  * @var CloudMunch\helper\NotificationHandler notification handler
  */
 private $notificationHandler;
 
 /**
  *
  * @param CloudMunch\loghandling\LogHandler $logHandler         
  * @param CloudMunch\AppContext $appContext         
  * @param CloudMunch\helper\NotificationHandler $notificationHandler         
  */
 public function __construct($logHandler, $appContext, $notificationHandler = null) {
  $this->appContext = $appContext;
  $this->logHelper = $logHandler;
  if (is_null ( $notificationHandler )) {
   $notificationHandler = new NotificationHandler ( $this->logHelper, $this->appContext, $this );
  }
  $this->notificationHandler = $notificationHandler;
 }
 
 /**
  * Retreives data for given context
  *
  * @param string $url         
  * @param string $apikey         
  * @param string $querystring         
  * @return boolean|jsonobject|string
  */
 function getDataForContext($url, $apikey, $querystring) {
  if (empty ( $querystring )) {
   $url = $url . static::APIKEY . $apikey;
  } else {
   $url = $url . static::APIKEY . $apikey . "&" . $querystring;
  }
  
  $result = $this->do_curl ( $url, null, "GET", null, null );
  
  $result = $result [static::RESPONSE];
  
  if (($result == null) || (is_null ( json_decode ( $result ) ))) {
   return false;
  }
  
  if ((! empty ( $resultdecode->request->status )) && ($resultdecode->request->status !== static::SUCCESS)) {
   $this->logHelper->log ( ERROR, $resultdecode->request->message );
   if ($resultdecode->request->request_id) {
    $this->logHelper->log ( ERROR, static::REQUESTID . " : " . $resultdecode->request->request_id );
    $this->notificationHandler->sendSlackNotification ( $resultdecode->request->message . "." . static::REQUESTID . " : " . $resultdecode->request->request_id );
   }
   return false;
  }
  
  return $resultdecode;
 }
 
 /**
  * Download key for google service
  *
  * @param string $url         
  * @param string $apikey         
  * @param string $querystring         
  * @return boolean
  */
 function downloadGSkey($url, $apikey, $querystring) {
  if (empty ( $querystring )) {
   $url = $url . static::APIKEY . $apikey;
  } else {
   $url = $url . static::APIKEY . $apikey . "&" . $querystring;
  }
  
  $result = $this->do_curl ( $url, null, "GET", null, null );
  
  $result = $result [static::RESPONSE];
  
  if (($result == null)) {
   return false;
  }
  return $result;
 }
 
 /**
  * Update data for given context.
  *
  * @param $url string         
  * @param $apikey string
  *         $data array
  *         $comment string
  * @return json object in the format {"data":{"id":"contextid","name":"contextname"},"request":{"status":"SUCCESS"}}
  */
 function putDataForContext($url, $apikey, $data, $comment = null) {
  // default data to be updated for all updates
  $data [application_id] = $this->appContext->getProject ();
  $data [pipeline_id] = $this->appContext->getJob ();
  $data [run_id] = $this->appContext->getRunNumber ();
  
  $dat = array (
    "data" => $this->json_object ( $data ) 
  );
  
  if (! is_null ( $comment ) && strlen ( $comment ) > 0) {
   $dat [comment] = $comment;
  }
  
  $dat = $this->json_string ( $this->json_object ( $dat ) );
  $url = $url . static::APIKEY . $apikey;
  
  $result = $this->do_curl ( $url, null, "POST", $dat, null );
  
  $result = $result [static::RESPONSE];
  $result = json_decode ( $result );
  
  if (($result == null) || ($result->request->status !== static::SUCCESS)) {
   $this->logHelper->log ( ERROR, $result->request->message );
   $this->logHelper->log ( ERROR, "Not able to post data to cloudmunch" );
   if ($result->request->request_id) {
    $this->logHelper->log ( ERROR, static::REQUESTID . " : " . $result->request->request_id );
    $this->notificationHandler->sendSlackNotification ( $result->request->message . ". " . static::REQUESTID . " : " . $result->request->request_id );
   }
   return false;
  }
  
  return $result;
 }
 
 /**
  * Patch data for given context.
  *
  * @param string $url         
  * @param string $apikey         
  * @param array $data         
  * @param string $comment         
  * @return boolean
  */
 function updateDataForContext($url, $apikey, $data, $comment = null) {
  // default data to be updated for all updates
  $data [application_id] = $this->appContext->getProject ();
  $data [pipeline_id] = $this->appContext->getJob ();
  $data [run_id] = $this->appContext->getRunNumber ();
  
  $dat = array (
    "data" => $this->json_object ( $data ) 
  );
  
  if (! is_null ( $comment ) && strlen ( $comment ) > 0) {
   $dat [comment] = $comment;
  }
  
  $dat = $this->json_string ( $this->json_object ( $dat ) );
  
  $url = $url . static::APIKEY . $apikey;
  
  $result = $this->do_curl ( $url, null, "PATCH", $dat, null );
  
  $result = $result [static::RESPONSE];
  $result = json_decode ( $result );
  
  if (($result == null) || ($result->request->status !== static::SUCCESS)) {
   $this->logHelper->log ( ERROR, $result->request->message );
   $this->logHelper->log ( ERROR, "Not able to patch data to cloudmunch" );
   if ($result->request->request_id) {
    $this->logHelper->log ( ERROR, static::REQUESTID . " : " . $result->request->request_id );
    $this->notificationHandler->sendSlackNotification ( $result->request->message . ". " . static::REQUESTID . " : " . $result->request->request_id );
   }
   return false;
  }
  
  return $result;
 }
 
 /**
  * Delete data for given context.
  *
  * @param string $url         
  * @param string $apikey         
  * @return boolean|unknown
  */
 function deleteDataForContext($url, $apikey) {
  $url = $url . static::APIKEY . $apikey;
  $result = $this->do_curl ( $url, null, "DELETE", null, null );
  $result = $result [static::RESPONSE];
  $result = json_decode ( $result );
  if (($result == null) || ($result->request->status != static::SUCCESS)) {
   $this->logHelper->log ( ERROR, $result->request->message );
   $this->logHelper->log ( ERROR, "Not able to put data to cloudmunch" );
   if ($result->request->request_id) {
    $this->logHelper->log ( ERROR, static::REQUESTID . " : " . $result->request->request_id );
   }
   return false;
  }
  
  return $result;
 }
 
 /**
  * This method is to invoke notify api on cloudmunch.
  *
  * @param string $serverurl
  *         : base server url
  * @param string $apikey
  *         : Api key.
  * @param string $contextarray
  *         : an array of components of the notification
  * @return boolean : success status
  */
 function sendNotification($serverurl, $apikey, $contextarray) {
  if (empty ( $serverurl ) || empty ( $apikey ) || empty ( $apikey )) {
   return false;
  }
  
  $data = $this->json_string ( $contextarray );
  
  $url = $serverurl . "?action=notify&apikey=" . $apikey;
  $result = $this->do_curl ( $url, null, "POST", $data, null );
  
  $result = $result [static::RESPONSE];
  $result = json_decode ( $result );
  if (($result == null) || ($result->request->status !== static::SUCCESS)) {
   $this->logHelper->log ( ERROR, $result->request->message );
   $this->logHelper->log ( ERROR, "Not able to send notification to cloudmunch" );
   return false;
  } else {
   return true;
  }
 }
 
 /**
  * Download the file source to given destination.
  *
  * @param string $url         
  * @param string $apikey         
  * @param string $source         
  * @param string $destination         
  * @return boolean
  */
 function downloadFile($url, $apikey, $source, $destination = null) {
  $devnull = "&> /dev/null";
  set_time_limit ( 0 );
  $url = $url . static::APIKEY . $apikey . "&file=/" . $source . "&mode=DOWNLOAD";
  $workspace = $this->appContext->getWorkSpaceLocation ();
  $tempFile = $workspace . "/" . "file" . rand ();
  
  // This is the file where we save the information
  $fp = fopen ( $tempFile, 'w+' );
  // Here is the file we are downloading, replace spaces with %20
  $ch = curl_init ( str_replace ( " ", "%20", $url ) );
  curl_setopt ( $ch, CURLOPT_TIMEOUT, 600 );
  // write curl response to file
  curl_setopt ( $ch, CURLOPT_FILE, $fp );
  curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
  // get curl response
  curl_exec ( $ch );
  $responseCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
  
  if ($responseCode !== 200) {
   $this->logHelper->log ( "INFO", "Unable to download files!" );
   curl_close ( $ch );
   fclose ( $fp );
   system ( "rm " . $tempFile . $devnull );
   return false;
  }
  
  curl_close ( $ch );
  fclose ( $fp );
  
  $returnValue = 0;
  if (! is_null ( $destination )) {
   $destination = $workspace . "/" . $destination;
   system ( "mkdir -p " . $destination . " " . $devnull );
   system ( "unzip -o " . $tempFile . " -d " . $destination . " " . $devnull, $returnValue );
  } else {
   system ( "unzip -o " . $tempFile . " " . $devnull, $returnValue );
  }
  
  system ( "rm " . $tempFile . " " . $devnull );
  if ($returnValue !== 0 && $returnValue !== 1) {
   return false;
  }
  return true;
 }
 
 /**
  * A helper function for curl.
  *
  * @param string $url         
  * @param string $headers         
  * @param string $requestType         
  * @param string $data         
  * @param string $curlOpts         
  * @return array
  */
 function do_curl($url, $headers = null, $requestType = null, $data = null, $curlOpts = null) {
  $userAgent = 'curl/7.24.0 (x86_64-redhat-linux-gnu)';
  $userAgent .= ' libcurl/7.24.0 NSS/3.13.5.0 zlib/1.2.5 libidn/1.18 libssh2/1.2.2';
  $ch = curl_init ();
  curl_setopt ( $ch, CURLOPT_HEADER, false );
  curl_setopt ( $ch, CURLOPT_VERBOSE, true );
  if (! empty ( $headers )) {
   curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
  }
  curl_setopt ( $ch, CURLOPT_URL, $url );
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
  
  if (! empty ( $requestType )) {
   curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, $requestType );
   if (! empty ( $data )) {
    // strip html tags and post
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, preg_replace ( '@<[\/\!]*?[^<>]*?>@si', '', $this->json_string ( $data ) ) );
   }
  }
  
  curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
  curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
  curl_setopt ( $ch, CURLOPT_CERTINFO, true );
  curl_setopt ( $ch, CURLOPT_USERAGENT, $userAgent );
  curl_setopt ( $ch, CURLINFO_HEADER_OUT, true );
  curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
  
  $curlOpts = $this->json_object ( $curlOpts );
  if (! empty ( $curlOpts )) {
   foreach ( $curlOpts as $curlOption => $curlOptionValue ) {
    if ($curlOption == 'CURLOPT_USERPWD') {
     $curlOption = CURLOPT_USERPWD;
    }
    
    curl_setopt ( $ch, $curlOption, $curlOptionValue );
   }
  }
  
  $results = curl_exec ( $ch );
  
  if (! $results) {
   $curlMsg = curl_error ( $ch );
   $msg = "ERROR: Could not request provider " . $curlMsg;
   $hostDown = "503 Service Unavailable";
   $this->logHelper->log ( "INFO", "Request to provider ended in error. Response:" . $curlMsg );
   if (strstr ( $msg, $hostDown )) {
    $this->logHelper->log ( "INFO", "Provider service is not available now. Please retry after some time." );
   } elseif (strstr ( $msg, " 404 " )) {
    $this->logHelper->log ( "INFO", "Provider service is not found or not configured correctly. Please contact support" );
   } elseif (strstr ( $msg, "Operation timed out" )) {
    $this->logHelper->log ( "INFO", "Provider service operation timed out. Please retry after some time." );
   }
  } else {
   $responseCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
   $headerSent = curl_getinfo ( $ch, CURLINFO_HEADER_OUT );
   $msg = $results;
  }
  $responseCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
  $headerSent = curl_getinfo ( $ch, CURLINFO_HEADER_OUT );
  curl_close ( $ch );
  if ($responseCode != 200) {
   if ($responseCode === 0) {
    $this->logHelper->log ( ERROR, "Interface system url host could not be resolved. Please check configurations/settings" );
   } elseif ($responseCode === 401) {
    $this->logHelper->log ( ERROR, "Interface system url host could not be accessed due to authentication failure" );
   } else {
    
    $this->logHelper->log ( ERROR, "Service is not available" );
   }
  }
  $response = array ();
  $response ["code"] = $responseCode;
  $response ["header"] = $headerSent;
  $response [static::RESPONSE] = $results;
  
  return $response;
 }
 
 /**
  * Converts given array or string to json object.
  *
  * @param string|array $data         
  * @return Json object
  */
 function json_object($data) {
  if (is_scalar ( $data )) {
   return json_decode ( $data );
  } else {
   if (is_array ( $data )) {
    return json_decode ( json_encode ( $data, JSON_UNESCAPED_SLASHES ) );
   } else {
    return $data;
   }
  }
 }
 
 /**
  * Converts given object to json string
  *
  * @param string|array $data         
  * @return string
  */
 function json_string($data) {
  if (is_scalar ( $data )) {
   return $data;
  } else {
   return json_encode ( $data, JSON_UNESCAPED_SLASHES );
  }
 }
 
 /**
  *
  * @param string $haystack         
  * @param string $needle         
  * @return boolean true if haystack starts with needle
  */
 function startsWith($haystack, $needle) {
  if (($haystack === null) || ($needle === null)) {
   return ($haystack === $needle);
  }
  if (! is_scalar ( $haystack )) {
   $haystack = $this->json_string ( $haystack );
  }
  if (! is_scalar ( $needle )) {
   $needle = $this->json_string ( $needle );
  }
  return $needle === "" || strpos ( $haystack, $needle ) === 0;
 }
 
 /**
  * Coverts html document to string.
  *
  * @param string $document         
  * @return string
  */
 function html2txt($document) {
  /*
   * Strip out javascript
   * Strip out HTML tags
   * Strip style tags properly
   * Strip multi-line comments including CDATA
   */
  $search = array (
    '@<script[^>]*?>.*?</script>@si',
    '@<[\/\!]*?[^<>]*?>@si',
    '@<style[^>]*?>.*?</style>@siU',
    '@<![\s\S]*?--[ \t\n\r]*>@' 
  );
  $text = preg_replace ( $search, '_$_', $document );
  $textx = explode ( '_$_', $text );
  $text = "";
  foreach ( $textx as $value ) {
   $text .= " " . $value;
  }
  return $text;
 }
}
?>
