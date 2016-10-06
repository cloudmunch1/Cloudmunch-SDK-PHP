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
 private $imageID = "";
 private $privateKeyLoc = "";
 private $publicKeyLoc = "";
 private $loginUser = "";
 private $serverType = "";

 private $provider = "";
 private $region = "";
 private $instancesize = "";
 private $password = null;
 private $sshport = 22;
 function getSSHPort() {
  return $this->sshport;
 }
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
  *
  * @param
  *         string public DNS of server
  */
 function setDNS($dns) {
  $this->dns = $dns;
 }
 function getImageID() {
  return $this->imageID;
 }
 function setImageID($imageid) {
  $this->imageID = $imageid;
 }
 function getPrivateKeyLoc() {
  return $this->privateKeyLoc;
 }
 function setPrivateKeyLoc($pkey) {
  $this->privateKeyLoc = $pkey;
 }
 function getPublicKeyLoc() {
  return $this->publicKeyLoc;
 }
 function setPublicKeyLoc($ploc) {
  $this->publicKeyLoc = $ploc;
 }
 function getLoginUser() {
  return $this->loginUser;
 }
 function setLoginUser($luser) {
  $this->loginUser = $luser;
 }
 function getServerType() {
  return $this->serverType;
 }
 function setServerType($stype) {
  $this->serverType = $stype;
 }
 
 function getProvider() {
  return $this->provider;
 }
 function setProvider($provider) {
  $this->provider = $provider;
 }
 function getRegion() {
  return $this->region;
 }
 function setRegion($region) {
  $this->region = $region;
 }
 function getInstancesize() {
  return $this->instancesize;
 }
 function setInstancesize($isize) {
  $this->instancesize = $isize;
 }
 function getPassword() {
  return $this->password;
 }
 function setPassword($eid) {
  $this->password = $eid;
 }
}

?>
