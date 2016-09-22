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
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/ServerHelper.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/CMDataManager.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/Server.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/NotificationHandler.php';
use CloudMunch\helper\ServerHelper;
class ServerHelperTest extends PHPUnit_Framework_TestCase
{


	/**
	 * @covers CloudMunch\helper\ServerHelper::__construct
	 */
	public function test_construct(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();

		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		$serverhelper=new ServerHelper($appcontext,$loghandler);

	}
	/**
	 * @covers CloudMunch\helper\ServerHelper::getServer
	 */
	public function test_getServer(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		
		$dmmanager = $this->getMockBuilder("CloudMunch\datamanager\CMDataManager")
		->setMethods(array("getDataForContext"))
		->disableOriginalConstructor()
		->getMock();
		$dat=array("id"=>"serverid","description"=>"desc");
		$darray=array("data"=>$dat);
		$ena=json_encode($darray);
		$dmmanager->expects($this->any())
		->method(getDataForContext)
		->will($this->returnValue(json_decode($ena)));
		
		
		
		
		
		
		$serverhelper=new ServerHelper($appcontext,$loghandler);
		$reflection = new ReflectionClass($serverhelper);
		$reflection_property = $reflection->getProperty(cmDataManager);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($serverhelper, $dmmanager);
		$server=$serverhelper->getServer("testserver");
		
	}
	
}