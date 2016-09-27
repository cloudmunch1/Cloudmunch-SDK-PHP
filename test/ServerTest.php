<?php

/**
 *  (c) CloudMunch Inc.
*  All Rights Reserved
*  Un-authorized copying of this file, via any medium is strictly prohibited
*  Proprietary and confidential
*
*  Rosmi rosmi@cloudmunch.com, Sept-23-2016
*/
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/AppAbstract.php';
//require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/ElasticBeanStalkServer.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/Server.php';
use CloudMunch\datamanager\Server;

class ServerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers CloudMunch\datamanager\Server::getTier
	 */
	public function test_getTier(){
		$server=new Server();
		$server->setTier("tier1");
		$actual=$server->getTier();
		$this->assertEquals("tier1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setTier
	 */
	public function test_setTier(){
		$server=new Server();
		$server->setTier("tier1");
		$actual=$server->getTier();
		$this->assertEquals("tier1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getSSHPort
	 */
	public function test_getSSHPort(){
		$server=new Server();
		$server->setSSHPort("22");
		$actual=$server->getSSHPort();
		$this->assertEquals("22",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setSSHPort
	 */
	public function test_setSSHPort(){
		$server=new Server();
		$server->setSSHPort("22");
		$actual=$server->getSSHPort();
		$this->assertEquals("22",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getServerName
	 */
	public function test_getServerName(){
		$server=new Server();
		$server->setServerName("server1");
		$actual=$server->getServerName();
		$this->assertEquals("server1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setServerName
	 */
	public function test_setServerName(){
		$server=new Server();
		$server->setServerName("server1");
		$actual=$server->getServerName();
		$this->assertEquals("server1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getDescription
	 */
	public function test_getDescription(){
		$server=new Server();
		$server->setDescription("serverdesc");
		$actual=$server->getDescription();
		$this->assertEquals("serverdesc",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setDescription
	 */
	public function test_setDescription(){
		$server=new Server();
		$server->setDescription("serverdesc");
		$actual=$server->getDescription();
		$this->assertEquals("serverdesc",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getDNS
	 */
	public function test_getDNS(){
		$server=new Server();
		$server->setDNS("dns");
		$actual=$server->getDNS();
		$this->assertEquals("dns",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setDNS
	 */
	public function test_setDNS(){
		$server=new Server();
		$server->setDNS("dns");
		$actual=$server->getDNS();
		$this->assertEquals("dns",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getDomainName
	 */
	public function test_getDomainName(){
		$server=new Server();
		$server->setDomainName("dns");
		$actual=$server->getDomainName();
		$this->assertEquals("dns",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setDomainName
	 */
	public function test_setDomainName(){
		$server=new Server();
		$server->setDomainName("dns");
		$actual=$server->getDomainName();
		$this->assertEquals("dns",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getCI
	 */
	public function test_getCI(){
		$server=new Server();
		$server->setCI("dns");
		$actual=$server->getCI();
		$this->assertEquals("dns",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setCI
	 */
	public function test_setCI(){
		$server=new Server();
		$server->setCI("dns");
		$actual=$server->getCI();
		$this->assertEquals("dns",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getDeploymentStatus
	 */
	public function test_getDeploymentStatus(){
		$server=new Server();
		$server->setDeploymentStatus("start");
		$actual=$server->getDeploymentStatus();
		$this->assertEquals("start",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setDeploymentStatus
	 */
	public function test_setDeploymentStatus(){
		$server=new Server();
		$server->setDeploymentStatus("start");
		$actual=$server->getDeploymentStatus();
		$this->assertEquals("start",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getInstanceId
	 */
	public function test_getInstanceId(){
		$server=new Server();
		$server->setInstanceId("instid");
		$actual=$server->getInstanceId();
		$this->assertEquals("instid",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setInstanceId
	 */
	public function test_setInstanceId(){
		$server=new Server();
		$server->setInstanceId("instid");
		$actual=$server->getInstanceId();
		$this->assertEquals("instid",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getImageID
	 */
	public function test_getImageID(){
		$server=new Server();
		$server->setImageID("imageid");
		$actual=$server->getImageID();
		$this->assertEquals("imageid",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setImageID
	 */
	public function test_setImageID(){
		$server=new Server();
		$server->setImageID("imageid");
		$actual=$server->getImageID();
		$this->assertEquals("imageid",$actual);
	}
	
	
	/**
	 * @covers CloudMunch\datamanager\Server::getLauncheduser
	 */
	public function test_getLauncheduser(){
		$server=new Server();
		$server->setLauncheduser("user");
		$actual=$server->getLauncheduser();
		$this->assertEquals("user",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setLauncheduser
	 */
	public function test_setLauncheduser(){
		$server=new Server();
		$server->setLauncheduser("user");
		$actual=$server->getLauncheduser();
		$this->assertEquals("user",$actual);
	}
	/**
	 * @covers CloudMunch\datamanager\Server::getBuild
	 */
	public function test_getBuild(){
		$server=new Server();
		$server->setBuild("1");
		$actual=$server->getBuild();
		$this->assertEquals("1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setBuild
	 */
	public function test_setBuild(){
		$server=new Server();
		$server->setBuild("1");
		$actual=$server->getBuild();
		$this->assertEquals("1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getAppName
	 */
	public function test_getAppName(){
		$server=new Server();
		$server->setAppName("App1");
		$actual=$server->getAppName();
		$this->assertEquals("App1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setAppName
	 */
	public function test_setAppName(){
		$server=new Server();
		$server->setAppName("App1");
		$actual=$server->getAppName();
		$this->assertEquals("App1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getDeployTempLoc
	 */
	public function test_getDeployTempLoc(){
		$server=new Server();
		$server->setDeployTempLoc("temp");
		$actual=$server->getDeployTempLoc();
		$this->assertEquals("temp",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setDeployTempLoc
	 */
	public function test_setDeployTempLoc(){
		$server=new Server();
		$server->setDeployTempLoc("temp");
		$actual=$server->getDeployTempLoc();
		$this->assertEquals("temp",$actual);
	}
	
	
	/**
	 * @covers CloudMunch\datamanager\Server::getBuildLocation
	 */
	public function test_getBuildLocation(){
		$server=new Server();
		$server->setBuildLocation("loc");
		$actual=$server->getBuildLocation();
		$this->assertEquals("loc",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setBuildLocation
	 */
	public function test_setBuildLocation(){
		$server=new Server();
		$server->setBuildLocation("loc");
		$actual=$server->getBuildLocation();
		$this->assertEquals("loc",$actual);
	}
	
	
	
	
	/**
	 * @covers CloudMunch\datamanager\Server::getPrivateKeyLoc
	 */
	public function test_getPrivateKeyLoc(){
		$server=new Server();
		$server->setPrivateKeyLoc("loc");
		$actual=$server->getPrivateKeyLoc();
		$this->assertEquals("loc",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setPrivateKeyLoc
	 */
	public function test_setPrivateKeyLoc(){
		$server=new Server();
		$server->setPrivateKeyLoc("loc");
		$actual=$server->getPrivateKeyLoc();
		$this->assertEquals("loc",$actual);
	}
	
	
	/**
	 * @covers CloudMunch\datamanager\Server::getPublicKeyLoc
	 */
	public function test_getPublicKeyLoc(){
		$server=new Server();
		$server->setPublicKeyLoc("loc");
		$actual=$server->getPublicKeyLoc();
		$this->assertEquals("loc",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setPublicKeyLoc
	 */
	public function test_setPublicKeyLoc(){
		$server=new Server();
		$server->setPublicKeyLoc("loc");
		$actual=$server->getPublicKeyLoc();
		$this->assertEquals("loc",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getLoginUser
	 */
	public function test_getLoginUser(){
		$server=new Server();
		$server->setLoginUser("user1");
		$actual=$server->getLoginUser();
		$this->assertEquals("user1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setLoginUser
	 */
	public function test_setLoginUser(){
		$server=new Server();
		$server->setLoginUser("user1");
		$actual=$server->getLoginUser();
		$this->assertEquals("user1",$actual);
	}
	/**
	 * @covers CloudMunch\datamanager\Server::getServerType
	 */
	public function test_getServerType(){
		$server=new Server();
		$server->setServerType("ec2");
		$actual=$server->getServerType();
		$this->assertEquals("ec2",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setServerType
	 */
	public function test_setServerType(){
		$server=new Server();
		$server->setServerType("ec2");
		$actual=$server->getServerType();
		$this->assertEquals("ec2",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getAssettype
	 */
	public function test_getAssettype(){
		$server=new Server();
		$server->setAssettype("ec2");
		$actual=$server->getAssettype();
		$this->assertEquals("ec2",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setAssettype
	 */
	public function test_setAssettype(){
		$server=new Server();
		$server->setAssettype("ec2");
		$actual=$server->getAssettype();
		$this->assertEquals("ec2",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getStatus
	 */
	public function test_getStatus(){
		$server=new Server();
		$server->setStatus("running");
		$actual=$server->getStatus();
		$this->assertEquals("running",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setStatus
	 */
	public function test_setStatus(){
		$server=new Server();
		$server->setStatus("running");
		$actual=$server->getStatus();
		$this->assertEquals("running",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getStarttime
	 */
	public function test_getStarttime(){
		$server=new Server();
		$server->setStarttime("time");
		$actual=$server->getStarttime();
		$this->assertEquals("time",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setStarttime
	 */
	public function test_setStarttime(){
		$server=new Server();
		$server->setStarttime("time");
		$actual=$server->getStarttime();
		$this->assertEquals("time",$actual);
	}
	
	
	/**
	 * @covers CloudMunch\datamanager\Server::getProvider
	 */
	public function test_getProvider(){
		$server=new Server();
		$server->setProvider("provider1");
		$actual=$server->getProvider();
		$this->assertEquals("provider1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setProvider
	 */
	public function test_setProvider(){
		$server=new Server();
		$server->setProvider("provider1");
		$actual=$server->getProvider();
		$this->assertEquals("provider1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getRegion
	 */
	public function test_getRegion(){
		$server=new Server();
		$server->setRegion("region");
		$actual=$server->getRegion();
		$this->assertEquals("region",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setRegion
	 */
	public function test_setRegion(){
		$server=new Server();
		$server->setRegion("region");
		$actual=$server->getRegion();
		$this->assertEquals("region",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getCmserver
	 */
	public function test_getCmserver(){
		$server=new Server();
		$server->setCmserver("yes");
		$actual=$server->getCmserver();
		$this->assertEquals("yes",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setCmserver
	 */
	public function test_setCmserver(){
		$server=new Server();
		$server->setCmserver("yes");
		$actual=$server->getCmserver();
		$this->assertEquals("yes",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getAssetname
	 */
	public function test_getAssetname(){
		$server=new Server();
		$server->setAssetname("asset1");
		$actual=$server->getAssetname();
		$this->assertEquals("asset1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setAssetname
	 */
	public function test_setAssetname(){
		$server=new Server();
		$server->setAssetname("asset1");
		$actual=$server->getAssetname();
		$this->assertEquals("asset1",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getInstancesize
	 */
	public function test_getInstancesize(){
		$server=new Server();
		$server->setInstancesize("micro");
		$actual=$server->getInstancesize();
		$this->assertEquals("micro",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setInstancesize
	 */
	public function test_setInstancesize(){
		$server=new Server();
		$server->setInstancesize("micro");
		$actual=$server->getInstancesize();
		$this->assertEquals("micro",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getEmailID
	 */
	public function test_getEmailID(){
		$server=new Server();
		$server->setEmailID("emailid");
		$actual=$server->getEmailID();
		$this->assertEquals("emailid",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setEmailID
	 */
	public function test_setEmailID(){
		$server=new Server();
		$server->setEmailID("emailid");
		$actual=$server->getEmailID();
		$this->assertEquals("emailid",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::getPassword
	 */
	public function test_getPassword(){
		$server=new Server();
		$server->setPassword("pass");
		$actual=$server->getPassword();
		$this->assertEquals("pass",$actual);
	}
	
	/**
	 * @covers CloudMunch\datamanager\Server::setPassword
	 */
	public function test_setPassword(){
		$server=new Server();
		$server->setPassword("pass");
		$actual=$server->getPassword();
		$this->assertEquals("pass",$actual);
	}
}