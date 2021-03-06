<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi Chandy rosmi@cloudmunch.com
 */
namespace CloudMunch\datamanager;

/**
 * Class Server
 * This class is to create server object ,that holds the data about a server.
 * 
 * @author rosmi
 * @package CloudMunch\datamanager
 *         
 */
class Server {
 
 /**
  *
  * @var string DNS name
  */
 private $dns = "";
 /**
  * 
  * @var string image id  of server
  */
 private $imageID = "";
 
 /**
  * 
  * @var string private key location.
  */
 private $privateKeyLoc = "";
 
 /**
  * 
  * @var string public key location.
  */
 private $publicKeyLoc = "";
 
 /**
  * 
  * @var string SSH login user name.
  */
 private $loginUser = "";
 
 /**
  * 
  * @var string type of server
  */
 private $serverType = "";

 /**
  * 
  * @var string The cloud provider
  */
 private $provider = "";
 
 /**
  * 
  * @var string region.
  */
 private $region = "";
 
 /**
  * 
  * @var string Size of server.
  */
 private $instancesize = "";
 
 /**
  * 
  * @var string SSH passowrd.
  */
 private $password = null;
 
 /**
  * 
  * @var string SSH port
  */
 private $sshport = 22;
 
 /**
  * Get SSH port.
  */
 function getSSHPort() {
  return $this->sshport;
 }
 
 /**
  * Set SSH port.
  * @param string $port
  */
 function setSSHPort($port) {
  $this->sshport = $port;
 }
 
 /**
  * Get public DNS of the server
  */
 function getDNS() {
  return $this->dns;
 }
 /**
  * Set public DNS of server.
  * @param
  *         string public DNS of server
  */
 function setDNS($dns) {
  $this->dns = $dns;
 }
 
 /**
  * Get server image ID
  */
 function getImageID() {
  return $this->imageID;
 }
 
 /**
  * Set server image id.
  * @param string $imageid
  */
 function setImageID($imageid) {
  $this->imageID = $imageid;
 }
 
 /**
  * Get private key location.
  */
 function getPrivateKeyLoc() {
  return $this->privateKeyLoc;
 }
 
 /**
  * Set private key location.
  * @param string  $pkey
  */
 function setPrivateKeyLoc($pkey) {
  $this->privateKeyLoc = $pkey;
 }
 
 /**
  * Get public key location.
  */
 function getPublicKeyLoc() {
  return $this->publicKeyLoc;
 }
 
 /**
  * Set public key location.
  * @param string $ploc
  */
 function setPublicKeyLoc($ploc) {
  $this->publicKeyLoc = $ploc;
 }
 
 /**
  * Get login user.
  */
 function getLoginUser() {
  return $this->loginUser;
 }
 
 /**
  * Set login user.
  * @param string $luser
  */
 function setLoginUser($luser) {
  $this->loginUser = $luser;
 }
 
 /**
  * Get server type.
  */
 function getServerType() {
  return $this->serverType;
 }
 
 /**
  * Set server type.
  * @param string $stype
  */
 function setServerType($stype) {
  $this->serverType = $stype;
 }
 
 /**
  * Get cloud provider.
  */
 function getProvider() {
  return $this->provider;
 }
 
 /**
  *  Set cloud provider.
  * @param string $provider
  */
 function setProvider($provider) {
  $this->provider = $provider;
 }
 
 /**
  * Get region.
  */
 function getRegion() {
  return $this->region;
 }
 
 /**
  * Set region.
  * @param string $region
  */
 function setRegion($region) {
  $this->region = $region;
 }
 
 /**
  * Get instance size.
  */
 function getInstancesize() {
  return $this->instancesize;
 }
 
 /**
  * Set instance size.
  * @param string $isize
  */
 function setInstancesize($isize) {
  $this->instancesize = $isize;
 }
 
 /**
  * Get SSH password.
  */
 function getPassword() {
  return $this->password;
 }
 
 /**
  * Set SSH password.
  * @param string $eid
  */
 function setPassword($eid) {
  $this->password = $eid;
 }
}

?>
