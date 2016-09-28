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
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/integrations/IntegrationDataHelper.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/LogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/AppErrorLogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/CloudmunchService.php';
use CloudMunch\integrations\IntegrationDataHelper;
class IntegrationDataHelperTest extends PHPUnit_Framework_TestCase
{

	function __construct()
	{
	}

	/**
	 * @covers CloudMunch\integrations\IntegrationDataHelper::getIntegrationData
	 */
	public function test_getIntegrationData(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		
		$cmservice = $this->getMockBuilder("CloudMunch\CloudmunchService")
		->setMethods(array("getCustomContextData"))
		->disableOriginalConstructor()
		->getMock();
		$intdata=json_decode('{"configuration":{"key":"value"}}');
		$cmservice->expects($this->any())
		->method("getCustomContextData")
		->will($this->returnValue($intdata));
		
		$integrationdatahelper=new IntegrationDataHelper($loghandler);
		$actual=$integrationdatahelper->getIntegrationData($cmservice,json_decode("{providername:provider}"));
		$result=array("key"=>"value");
		$this->assertEquals($actual,$result);
	}
}