<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 */
namespace CloudMunch\loghandling;

use CloudMunch\AppContext;

/**
 * Display message based on log level set in app context
 * LogLevel Message Types displayed
 * INFO All - except for DEBUG
 * DEBUG All
 * WARNING WARNING, ERROR and AUDIT
 * ERROR ERROR and AUDIT
 *
 * @package CloudMunch
 * @author Rosmi <rosmi@cloudmunch.com>
 * @author Amith <amith@cloudmunch.com>
 */
class LogHandler {
 
 /**
  *
  * @var CloudMunch\AppContext Reference to AppContext object.
  */
 private $appContext = null;
 
 /**
  *
  * @var string log level
  */
 private $logLevel = null;
 
 /**
  * Constructor to initialise application context.
  * @param CloudMunch\AppContext $appContext         
  */
 public function __construct($appContext) {
  $this->appContext = $appContext;
  $this->logLevel = $this->appContext->getLogLevel ();
 }
 
 /**
  * Returns true if log level is debug
  * 
  * @return boolean
  */
 public function isDebugEnabled() {
  return ($this->logLevel && (strtolower ( $this->logLevel ) === "debug"));
 }
 
 /**
  * Returns true if log level is info
  * 
  * @return boolean
  */
 public function isInfoEnabled() {
  return ! ($this->logLevel && (strtolower ( $this->logLevel ) === "error") || (strtolower ( $this->logLevel ) === "warning"));
 }
 
 /**
  * The method returns true if loglevel is either info, debug or warning
  * 
  * @return boolean
  */
 public function isWarningEnabled() {
  return ($this->logLevel && (strtolower ( $this->logLevel ) === "info") || (strtolower ( $this->logLevel ) === "warning") || (strtolower ( $this->logLevel ) === "debug"));
 }
 
 /**
  * This method logs messages according to log level.
  * 
  * @param string $msgNo
  *         log level DEBUG,INFO,ERROR, WARNING,AUDIT
  * @param string $msg
  *         message in the log
  */
 function log($msgNo, $msg) {
  try {
   date_default_timezone_set ( 'UTC' );
   $date = date ( 'Y-m-d H:i:s' );
  } catch ( Exception $se ) {
   echo "Exception :" . $se->getMessage ();
  }
  $stepname = $this->appContext->getStepName ();
  switch ($msgNo) {
   case DEBUG :
    if ($this->isDebugEnabled ()) {
     echo "<b>DEBUG</b> [$date][$stepname] $msg\n";
    }
    break;
   case INFO :
    if ($this->isInfoEnabled ()) {
     echo "<b>INFO</b> [$date][$stepname] $msg\n";
    }
    break;
   case ERROR :
    echo "<b>ERROR</b> [$date] [$stepname]$msg\n";
    break;
   case WARNING :
    if ($this->isWarningEnabled ()) {
     echo "<b>WARNING</b> [$date] [$stepname]$msg\n";
    }
    break;
   case AUDIT :
    echo "<b>AUDIT</b> [$date] [$stepname]$msg\n";
    break;
   
   default :
  }
 }
}