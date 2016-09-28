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
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/LogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/AppErrorLogHandler.php';
use CloudMunch\loghandling\LogHandler;
class LogHandlerTest extends PHPUnit_Framework_TestCase
{


	/**
	 * @covers CloudMunch\loghandling\LogHandler::__construct
	 */
	public function test_construct(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$loghandler=new LogHandler($appcontext);
		
	}
	/**
	 * @covers CloudMunch\loghandling\LogHandler::isDebugEnabled
	 */
	public function test_isDebugEnabled(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$appcontext->expects($this->any())
		->method("getLogLevel")
		->will($this->returnValue('DEBUG'));
		$loghandler=new LogHandler($appcontext);
		$actual=$loghandler->isDebugEnabled();
		$this->assertTrue($actual);
		
	}
	
	/**
	 * @covers CloudMunch\loghandling\LogHandler::isInfoEnabled
	 */
	public function test_isInfoEnabled(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$appcontext->expects($this->any())
		->method("getLogLevel")
		->will($this->returnValue('INFO'));
		$loghandler=new LogHandler($appcontext);
		$actual=$loghandler->isInfoEnabled();
		$this->assertTrue($actual);
	
	}
	
	/**
	 * @covers CloudMunch\loghandling\LogHandler::isWarningEnabled
	 */
	public function test_isWarningEnabled(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$appcontext->expects($this->any())
		->method("getLogLevel")
		->will($this->returnValue('WARNING'));
		$loghandler=new LogHandler($appcontext);
		$actual=$loghandler->isWarningEnabled();
		$this->assertTrue($actual);
	
	}
	
	
	/**
	 * @covers CloudMunch\loghandling\LogHandler::log
	 */
	public function test_logdebug(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$appcontext->expects($this->any())
		->method("getLogLevel")
		->will($this->returnValue('DEBUG'));
		$loghandler=new LogHandler($appcontext);
		$loghandler->log("DEBUG","This is log message");
		
	
	}
	
	/**
	 * @covers CloudMunch\loghandling\LogHandler::log
	 */
	public function test_logerror(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$appcontext->expects($this->any())
		->method("getLogLevel")
		->will($this->returnValue('ERROR'));
		$loghandler=new LogHandler($appcontext);
		$loghandler->log("ERROR","This is log message");
	
	
	}
	
	/**
	 * @covers CloudMunch\loghandling\LogHandler::log
	 */
	public function test_loginfo(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
		$appcontext->expects($this->any())
		->method("getLogLevel")
		->will($this->returnValue('INFO'));
		$loghandler=new LogHandler($appcontext);
		$loghandler->log("INFO","This is log message");
	
	
	}
	
	}