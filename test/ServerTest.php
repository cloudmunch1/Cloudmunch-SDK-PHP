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