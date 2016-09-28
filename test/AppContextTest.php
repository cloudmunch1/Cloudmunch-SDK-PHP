<?php

/**
 *  (c) CloudMunch Inc.
*  All Rights Reserved
*  Un-authorized copying of this file, via any medium is strictly prohibited
*  Proprietary and confidential
*
*  Rosmi rosmi@cloudmunch.com, Sept-27-2016
*/

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/AppContext.php';
use CloudMunch\AppContext;

class AppContextTest extends PHPUnit_Framework_TestCase{
	
	
	/**
	 * @covers CloudMunch\AppContext::getLogLevel
	 */
	public function test_getLogLevel(){
		$appcontext=new AppContext();
		$appcontext->setLogLevel("DEBUG");
		$actual=$appcontext->getLogLevel();
		$this->assertEquals("DEBUG",$actual);
		
	}
	
	/**
	 * @covers CloudMunch\AppContext::setLogLevel
	 */
	public function test_setLogLevel(){
		$appcontext=new AppContext();
		$appcontext->setLogLevel("DEBUG");
		$actual=$appcontext->getLogLevel();
		$this->assertEquals("DEBUG",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getMainbuildnumber
	 */
	public function test_getMainbuildnumber(){
		$appcontext=new AppContext();
		$appcontext->setMainbuildnumber("1");
		$actual=$appcontext->getMainbuildnumber();
		$this->assertEquals("1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setMainbuildnumber
	 */
	public function test_setMainbuildnumber(){
		$appcontext=new AppContext();
		$appcontext->setMainbuildnumber("2");
		$actual=$appcontext->getMainbuildnumber();
		$this->assertEquals("2",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getEnvironment
	 */
	public function test_getEnvironment(){
		$appcontext=new AppContext();
		$appcontext->setEnvironment("env1");
		$actual=$appcontext->getEnvironment();
		$this->assertEquals("env1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setEnvironment
	 */
	public function test_setEnvironment(){
		$appcontext=new AppContext();
		$appcontext->setEnvironment("env2");
		$actual=$appcontext->getEnvironment();
		$this->assertEquals("env2",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getTier
	 */
	public function test_getTier(){
		$appcontext=new AppContext();
		$appcontext->setTier("tier1");
		$actual=$appcontext->getTier();
		$this->assertEquals("tier1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setTier
	 */
	public function test_setTier(){
		$appcontext=new AppContext();
		$appcontext->setTier("tier2");
		$actual=$appcontext->getTier();
		$this->assertEquals("tier2",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getStepName
	 */
	public function test_getStepName(){
		$appcontext=new AppContext();
		$appcontext->setStepName("step1");
		$actual=$appcontext->getStepName();
		$this->assertEquals("step1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setStepName
	 */
	public function test_setStepName(){
		$appcontext=new AppContext();
		$appcontext->setStepName("step2");
		$actual=$appcontext->getStepName();
		$this->assertEquals("step2",$actual);
	
	}
	/**
	 * @covers CloudMunch\AppContext::getWorkSpaceLocation
	 */
	public function test_getWorkSpaceLocation(){
		$appcontext=new AppContext();
		$appcontext->setWorkSpaceLocation("workspaceloc");
		$actual=$appcontext->getWorkSpaceLocation();
		$this->assertEquals("workspaceloc",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setWorkSpaceLocation
	 */
	public function test_setWorkSpaceLocation(){
		$appcontext=new AppContext();
		$appcontext->setWorkSpaceLocation("workspaceloc1");
		$actual=$appcontext->getWorkSpaceLocation();
		$this->assertEquals("workspaceloc1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getArchiveLocation
	 */
	public function test_getArchiveLocation(){
		$appcontext=new AppContext();
		$appcontext->setArchiveLocation("archiveloc");
		$actual=$appcontext->getArchiveLocation();
		$this->assertEquals("archiveloc",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setArchiveLocation
	 */
	public function test_setArchiveLocation(){
			$appcontext=new AppContext();
		$appcontext->setArchiveLocation("archiveloc1");
		$actual=$appcontext->getArchiveLocation();
		$this->assertEquals("archiveloc1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getStepID
	 */
	public function test_getStepID(){
		$appcontext=new AppContext();
		$appcontext->setStepID("stepid");
		$actual=$appcontext->getStepID();
		$this->assertEquals("stepid",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setStepID
	 */
	public function test_setStepID(){
		$appcontext=new AppContext();
		$appcontext->setStepID("stepid1");
		$actual=$appcontext->getStepID();
		$this->assertEquals("stepid1",$actual);
	
	}
	/**
	 * @covers CloudMunch\AppContext::getTargetServer
	 */
	public function test_getTargetServer(){
		$appcontext=new AppContext();
		$appcontext->setTargetServer("server1");
		$actual=$appcontext->getTargetServer();
		$this->assertEquals("server1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setTargetServer
	 */
	public function test_setTargetServer(){
		$appcontext=new AppContext();
		$appcontext->setTargetServer("server2");
		$actual=$appcontext->getTargetServer();
		$this->assertEquals("server2",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getMasterURL
	 */
	public function test_getMasterURL(){
		$appcontext=new AppContext();
		$appcontext->setMasterURL("mURL");
		$actual=$appcontext->getMasterURL();
		$this->assertEquals("mURL",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setMasterURL
	 */
	public function test_setMasterURL(){
			$appcontext=new AppContext();
		$appcontext->setMasterURL("mURL1");
		$actual=$appcontext->getMasterURL();
		$this->assertEquals("mURL1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getDomainName
	 */
	public function test_getDomainName(){
		$appcontext=new AppContext();
		$appcontext->setDomainName("domain1");
		$actual=$appcontext->getDomainName();
		$this->assertEquals("domain1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setDomainName
	 */
	public function test_setDomainName(){
		$appcontext=new AppContext();
		$appcontext->setDomainName("domain2");
		$actual=$appcontext->getDomainName();
		$this->assertEquals("domain2",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getProject
	 */
	public function test_getProject(){
		$appcontext=new AppContext();
		$appcontext->setProject("project1");
		$actual=$appcontext->getProject();
		$this->assertEquals("project1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setProject
	 */
	public function test_setProject(){
		$appcontext=new AppContext();
		$appcontext->setProject("project2");
		$actual=$appcontext->getProject();
		$this->assertEquals("project2",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::getJob
	 */
	public function test_getJob(){
		$appcontext=new AppContext();
		$appcontext->setJob("job1");
		$actual=$appcontext->getJob();
		$this->assertEquals("job1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setJob
	 */
	public function test_setJob(){
		$appcontext=new AppContext();
		$appcontext->setJob("job2");
		$actual=$appcontext->getJob();
		$this->assertEquals("job2",$actual);
	}
	
	/**
	 * @covers CloudMunch\AppContext::getReportsLocation
	 */
	public function test_getReportsLocation(){
		$appcontext=new AppContext();
		$appcontext->setReportsLocation("reportloc");
		$actual=$appcontext->getReportsLocation();
		$this->assertEquals("reportloc",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setReportsLocation
	 */
	public function test_setReportsLocation(){
		$appcontext=new AppContext();
		$appcontext->setReportsLocation("reportloc1");
		$actual=$appcontext->getReportsLocation();
		$this->assertEquals("reportloc1",$actual);
	}
	
	/**
	 * @covers CloudMunch\AppContext::getRunNumber
	 */
	public function test_getRunNumber(){
		$appcontext=new AppContext();
		$appcontext->setRunNumber("1");
		$actual=$appcontext->getRunNumber();
		$this->assertEquals("1",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setRunNumber
	 */
	public function test_setRunNumber(){
		$appcontext=new AppContext();
		$appcontext->setRunNumber("2");
		$actual=$appcontext->getRunNumber();
		$this->assertEquals("2",$actual);
	}
	
	/**
	 * @covers CloudMunch\AppContext::getAPIKey
	 */
	public function test_getAPIKey(){
		$appcontext=new AppContext();
		$appcontext->setAPIKey("apikey");
		$actual=$appcontext->getAPIKey();
		$this->assertEquals("apikey",$actual);
	
	}
	
	/**
	 * @covers CloudMunch\AppContext::setAPIKey
	 */
	public function test_setAPIKey(){
		$appcontext=new AppContext();
		$appcontext->setAPIKey("apikey");
		$actual=$appcontext->getAPIKey();
		$this->assertEquals("apikey",$actual);
	}
}

