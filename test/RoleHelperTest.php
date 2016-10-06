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
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/RoleHelper.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/CMDataManager.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/NotificationHandler.php';
use CloudMunch\helper\RoleHelper;
class RoleHelperTest extends PHPUnit_Framework_TestCase
{

	
	/**
	 * @covers CloudMunch\helper\RoleHelper::__construct
	 */
	public function test_construct(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();

		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		$rolehelper=new RoleHelper($appcontext,$loghandler);
		
	}	
	
	/**
	 * @covers CloudMunch\helper\RoleHelper::isRoleNameUnique
	 */
	public function test_isRoleNameUnique(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		$rolehelper=new RoleHelper($appcontext,$loghandler);
		$roledata=array("name"=>"role1");
		$rolearray=array("id"=>$roledata);
		
		
		$rolearray=json_encode($rolearray);
		$actual=$rolehelper->isRoleNameUnique(json_decode($rolearray),"role1");
		
		
		$this->assertFalse($actual);
	}
	/**
	 * @covers CloudMunch\helper\RoleHelper::getExistingRoles
	 */
	public function test_getExistingRoles(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		$rolehelper=new RoleHelper($appcontext,$loghandler);
		
		$actual=$rolehelper->getExistingRoles(json_decode('{"name":"test"}'));
		$this->assertFalse($actual);
	}
	
	
	/**
	 * @covers CloudMunch\helper\RoleHelper::getRole
	 */
	public function test_getRole(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		$rolehelper=new RoleHelper($appcontext,$loghandler);
	
		$actual=$rolehelper->getRole("roleid",json_decode('{"name":"test"}'));
		$this->assertFalse($actual);
	}
	
	
	/**
	 * @covers CloudMunch\helper\RoleHelper::addRole
	 */
	public function test_addRole(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		$rolehelper=new RoleHelper($appcontext,$loghandler);
	
		$actual=$rolehelper->addRole("role1",array());
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\helper\RoleHelper::checkIfRoleExists
	 */
	public function test_checkIfRoleExists(){
		$appcontext = $this->getMockBuilder("CloudMunch\AppContext")
		->getMock();
	
		$loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
		->setConstructorArgs(array($appcontext))
		->getMock();
		$rolehelper=new RoleHelper($appcontext,$loghandler);
	
		$actual=$rolehelper->checkIfRoleExists("roleid");
		$this->assertFalse($actual);
	}
	
	/**
	 * @covers CloudMunch\helper\RoleHelper::checkIfRoleExists
	 */
	public function test_checkIfRoleExistsTrue(){
	 $appcontext = $this->getMockBuilder("CloudMunch\AppContext")
	 ->getMock();
	
	 $loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
	 ->setConstructorArgs(array($appcontext))
	 ->getMock();
	 
	 $dmmanager = $this->getMockBuilder("CloudMunch\datamanager\CMDataManager")
	 ->setMethods(array("getDataForContext"))
	 ->disableOriginalConstructor()
	 ->getMock();
	 
	 $dmmanager->expects($this->any())
	 ->method('getDataForContext')
	 ->will($this->returnValue(array("data"=>"test")));
	 
	 $rolehelper=new RoleHelper($appcontext,$loghandler);
	 $reflection = new ReflectionClass($rolehelper);
	 $reflection_property = $reflection->getProperty(cmDataManager);
	 $reflection_property->setAccessible(true);
	 $reflection_property->setValue($rolehelper, $dmmanager);
	 $actual=$rolehelper->checkIfRoleExists("roleid");
	 $this->assertTrue($actual);
	}
	
	/**
	 * @covers CloudMunch\helper\RoleHelper::updateRole
	 */
	public function test_updateRole(){
	 $appcontext = $this->getMockBuilder("CloudMunch\AppContext")
	 ->getMock();
	
	 $loghandler = $this->getMockBuilder("CloudMunch\loghandling\LogHandler")
	 ->setConstructorArgs(array($appcontext))
	 ->getMock();
	
	 $dmmanager = $this->getMockBuilder("CloudMunch\datamanager\CMDataManager")
	 ->setMethods(array("putDataForContext"))
	 ->disableOriginalConstructor()
	 ->getMock();
	
	
	
	 $rolehelper=new RoleHelper($appcontext,$loghandler);
	 $reflection = new ReflectionClass($rolehelper);
	 $reflection_property = $reflection->getProperty(cmDataManager);
	 $reflection_property->setAccessible(true);
	 $reflection_property->setValue($rolehelper, $dmmanager);
	 $rolehelper->updateRole("roleid", "roledata");
	
	}
	
}