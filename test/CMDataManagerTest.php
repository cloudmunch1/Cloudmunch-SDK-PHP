<?php
/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi rosmi@cloudmunch.com, Sept-23-2016
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/AppContext.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/LogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/CMDataManager.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/NotificationHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/AppErrorLogHandler.php';
use CloudMunch\datamanager\CMDataManager;
class CMDataManagerTest extends PHPUnit_Framework_TestCase
{


	/**
	 * @covers CloudMunch\datamanager\CMDataManager::__construct
	 */
	public function test_construct(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();

		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		
		$cmanager=new CMDataManager($appcontext,$loghandler,null);
		
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::getDataForContext
	 */
	public function test_getDataForContext(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$actual=$cmanager->getDataForContext("url","apikey","querystring");
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::downloadGSkey
	 */
	public function test_downloadGSkey(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$actual=$cmanager->downloadGSkey("url","apikey","querystring");
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::putDataForContext
	 */
	public function test_putDataForContext(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$actual=$cmanager->putDataForContext("url","apikey","querystring","comment");
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::updateDataForContext
	 */
	public function test_updateDataForContext(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$actual=$cmanager->updateDataForContext("url","apikey",array("field"=>"value"),"comment");
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::deleteDataForContext
	 */
	public function test_deleteDataForContext(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$actual=$cmanager->deleteDataForContext("url","apikey");
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::sendNotification
	 */
	public function test_sendNotification(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$actual=$cmanager->sendNotification("url","apikey",array("field"=>"value"));
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::downloadFile
	 */
	public function test_downloadFile(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$actual=$cmanager->downloadFile("url","apikey", "filesource", "destination");
		$this->assertFalse($actual);
	}
	
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::do_curl
	 */
	public function test_do_curl(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		$url=array("url"=>"testurl","headers"=>"header","method"=>"GET","data"=>array("field"=>"value"),"curl_options"=>array("CURLOPT_USERPWD"=>"test"));
		$cmanager->do_curl("url", "header", "GET", array("field"=>"value"), array("CURLOPT_USERPWD"=>"test"));
		
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::json_object
	 */
	public function test_json_object(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		//$url=array("url"=>"testurl","headers"=>"header","method"=>"GET","data"=>array("field"=>"value"),"curl_options"=>array("CURLOPT_USERPWD"=>"test"));
		$cmanager->json_object(array("field"=>"value"));
		$cmanager->json_object("{field:value}");
	
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::json_string
	 */
	public function test_json_string(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		//$url=array("url"=>"testurl","headers"=>"header","method"=>"GET","data"=>array("field"=>"value"),"curl_options"=>array("CURLOPT_USERPWD"=>"test"));
		$actual=$cmanager->json_string(array("field"=>"value"));
		
		$this->assertEquals("{\"field\":\"value\"}",$actual);
		$actual=$cmanager->json_string("{\"field\":\"value\"}");
		$this->assertEquals("{\"field\":\"value\"}",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::startsWith
	 */
	public function test_startsWith(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
		
		$actual=$cmanager->startsWith("testthis","test");
		$this->assertTrue($actual);
	}
	/**
	 * @covers CloudMunch\datamanager\CMDataManager::html2txt
	 */
	public function test_html2txt(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
	
		$cmanager=new CMDataManager($loghandler,$appcontext,null);
	
		$actual=$cmanager->html2txt("<!DOCTYPE html>
	<html>
	<body>
	
	<h1>My First Heading</h1>
	
	<p>My first paragraph.</p>
	
	</body>
	</html>","test");
		
		$this->assertContains('My First Heading', $actual);
	}
	
	
}