<?php
/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi rosmi@cloudmunch.com, Aug-28-2016
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/AppContext.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/AppErrorLogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/LogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/IntegrationHelper.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/CMDataManager.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/NotificationHandler.php';

use CloudMunch\helper\NotificationHandler;
class NotificationHandlerTest extends PHPUnit_Framework_TestCase
{


 /**
  * @covers CloudMunch\helper\NotificationHandler::__construct
  */
 public function test_construct(){
  $appcontext = $this->getMockBuilder("CloudMunch\AppContext")
  ->getMock();

  $loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
  ->setConstructorArgs(array($appcontext))
  ->getMock();
  $inthelper=new NotificationHandler($loghandler,$appcontext,null);

 }
 
 
 /**
  * @covers CloudMunch\helper\NotificationHandler::sendSlackNotification
  */
 public function test_sendSlackNotification(){
 	
 	$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
 	->getMock();
 	
 	$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
 	->setConstructorArgs(array($appcontext))
 	->getMock();
 	
 	
 	$dmmanager = $this->getMockBuilder("CloudMunch\datamanager\CMDataManager")
 	->setMethods(array("sendNotification"))
 	->disableOriginalConstructor()
 	->getMock();
 	
 	
 	
 	$inthelper=new NotificationHandler($loghandler,$appcontext,null);
 	$reflection = new ReflectionClass($inthelper);
 	$reflection_property = $reflection->getProperty(cmDataManager);
 	$reflection_property->setAccessible(true);
 	$reflection_property->setValue($inthelper, $dmmanager);
 	$inthelper->sendSlackNotification("message", "ERROR", "support", "from", "to");
 }

 
}