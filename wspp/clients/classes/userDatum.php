<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class userDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var integer
	*/
	public $id;
	/** 
	* @var integer
	*/
	public $confirmed;
	/** 
	* @var integer
	*/
	public $policyagreed;
	/** 
	* @var integer
	*/
	public $deleted;
	/** 
	* @var string
	*/
	public $username;
	/** 
	* @var string
	*/
	public $auth;
	/** 
	* @var string
	*/
	public $password;
	/** 
	* @var string
	*/
	public $passwordmd5;
	/** 
	* @var string
	*/
	public $idnumber;
	/** 
	* @var string
	*/
	public $firstname;
	/** 
	* @var string
	*/
	public $lastname;
	/** 
	* @var string
	*/
	public $email;
	/** 
	* @var integer
	*/
	public $emailstop;
	/** 
	* @var string
	*/
	public $icq;
	/** 
	* @var string
	*/
	public $skype;
	/** 
	* @var string
	*/
	public $yahoo;
	/** 
	* @var string
	*/
	public $aim;
	/** 
	* @var string
	*/
	public $msn;
	/** 
	* @var string
	*/
	public $phone1;
	/** 
	* @var string
	*/
	public $phone2;
	/** 
	* @var string
	*/
	public $institution;
	/** 
	* @var string
	*/
	public $department;
	/** 
	* @var string
	*/
	public $address;
	/** 
	* @var string
	*/
	public $city;
	/** 
	* @var string
	*/
	public $country;
	/** 
	* @var string
	*/
	public $lang;
	/** 
	* @var integer
	*/
	public $timezone;
	/** 
	* @var string
	*/
	public $lastip;
	/** 
	* @var string
	*/
	public $theme;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var integer
	*/
	public $mnethostid;

	/**
	* default constructor for class userDatum
	* @param string $action
	* @param integer $id
	* @param integer $confirmed
	* @param integer $policyagreed
	* @param integer $deleted
	* @param string $username
	* @param string $auth
	* @param string $password
	* @param string $passwordmd5
	* @param string $idnumber
	* @param string $firstname
	* @param string $lastname
	* @param string $email
	* @param integer $emailstop
	* @param string $icq
	* @param string $skype
	* @param string $yahoo
	* @param string $aim
	* @param string $msn
	* @param string $phone1
	* @param string $phone2
	* @param string $institution
	* @param string $department
	* @param string $address
	* @param string $city
	* @param string $country
	* @param string $lang
	* @param integer $timezone
	* @param string $lastip
	* @param string $theme
	* @param string $description
	* @param integer $mnethostid
	* @return userDatum
	*/
	 public function userDatum($action='',$id=0,$confirmed=0,$policyagreed=0,$deleted=0,$username='',$auth='',$password='',$passwordmd5='',$idnumber='',$firstname='',$lastname='',$email='',$emailstop=0,$icq='',$skype='',$yahoo='',$aim='',$msn='',$phone1='',$phone2='',$institution='',$department='',$address='',$city='',$country='',$lang='',$timezone=0,$lastip='',$theme='',$description='',$mnethostid=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->confirmed=$confirmed   ;
		 $this->policyagreed=$policyagreed   ;
		 $this->deleted=$deleted   ;
		 $this->username=$username   ;
		 $this->auth=$auth   ;
		 $this->password=$password   ;
		 $this->passwordmd5=$passwordmd5   ;
		 $this->idnumber=$idnumber   ;
		 $this->firstname=$firstname   ;
		 $this->lastname=$lastname   ;
		 $this->email=$email   ;
		 $this->emailstop=$emailstop   ;
		 $this->icq=$icq   ;
		 $this->skype=$skype   ;
		 $this->yahoo=$yahoo   ;
		 $this->aim=$aim   ;
		 $this->msn=$msn   ;
		 $this->phone1=$phone1   ;
		 $this->phone2=$phone2   ;
		 $this->institution=$institution   ;
		 $this->department=$department   ;
		 $this->address=$address   ;
		 $this->city=$city   ;
		 $this->country=$country   ;
		 $this->lang=$lang   ;
		 $this->timezone=$timezone   ;
		 $this->lastip=$lastip   ;
		 $this->theme=$theme   ;
		 $this->description=$description   ;
		 $this->mnethostid=$mnethostid   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
	}


	/**
	* @return integer
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return integer
	*/
	public function getConfirmed(){
		 return $this->confirmed;
	}


	/**
	* @return integer
	*/
	public function getPolicyagreed(){
		 return $this->policyagreed;
	}


	/**
	* @return integer
	*/
	public function getDeleted(){
		 return $this->deleted;
	}


	/**
	* @return string
	*/
	public function getUsername(){
		 return $this->username;
	}


	/**
	* @return string
	*/
	public function getAuth(){
		 return $this->auth;
	}


	/**
	* @return string
	*/
	public function getPassword(){
		 return $this->password;
	}


	/**
	* @return string
	*/
	public function getPasswordmd5(){
		 return $this->passwordmd5;
	}


	/**
	* @return string
	*/
	public function getIdnumber(){
		 return $this->idnumber;
	}


	/**
	* @return string
	*/
	public function getFirstname(){
		 return $this->firstname;
	}


	/**
	* @return string
	*/
	public function getLastname(){
		 return $this->lastname;
	}


	/**
	* @return string
	*/
	public function getEmail(){
		 return $this->email;
	}


	/**
	* @return integer
	*/
	public function getEmailstop(){
		 return $this->emailstop;
	}


	/**
	* @return string
	*/
	public function getIcq(){
		 return $this->icq;
	}


	/**
	* @return string
	*/
	public function getSkype(){
		 return $this->skype;
	}


	/**
	* @return string
	*/
	public function getYahoo(){
		 return $this->yahoo;
	}


	/**
	* @return string
	*/
	public function getAim(){
		 return $this->aim;
	}


	/**
	* @return string
	*/
	public function getMsn(){
		 return $this->msn;
	}


	/**
	* @return string
	*/
	public function getPhone1(){
		 return $this->phone1;
	}


	/**
	* @return string
	*/
	public function getPhone2(){
		 return $this->phone2;
	}


	/**
	* @return string
	*/
	public function getInstitution(){
		 return $this->institution;
	}


	/**
	* @return string
	*/
	public function getDepartment(){
		 return $this->department;
	}


	/**
	* @return string
	*/
	public function getAddress(){
		 return $this->address;
	}


	/**
	* @return string
	*/
	public function getCity(){
		 return $this->city;
	}


	/**
	* @return string
	*/
	public function getCountry(){
		 return $this->country;
	}


	/**
	* @return string
	*/
	public function getLang(){
		 return $this->lang;
	}


	/**
	* @return integer
	*/
	public function getTimezone(){
		 return $this->timezone;
	}


	/**
	* @return string
	*/
	public function getLastip(){
		 return $this->lastip;
	}


	/**
	* @return string
	*/
	public function getTheme(){
		 return $this->theme;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return integer
	*/
	public function getMnethostid(){
		 return $this->mnethostid;
	}

	/*set accessors */

	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
	}


	/**
	* @param integer $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param integer $confirmed
	* @return void
	*/
	public function setConfirmed($confirmed){
		$this->confirmed=$confirmed;
	}


	/**
	* @param integer $policyagreed
	* @return void
	*/
	public function setPolicyagreed($policyagreed){
		$this->policyagreed=$policyagreed;
	}


	/**
	* @param integer $deleted
	* @return void
	*/
	public function setDeleted($deleted){
		$this->deleted=$deleted;
	}


	/**
	* @param string $username
	* @return void
	*/
	public function setUsername($username){
		$this->username=$username;
	}


	/**
	* @param string $auth
	* @return void
	*/
	public function setAuth($auth){
		$this->auth=$auth;
	}


	/**
	* @param string $password
	* @return void
	*/
	public function setPassword($password){
		$this->password=$password;
	}


	/**
	* @param string $passwordmd5
	* @return void
	*/
	public function setPasswordmd5($passwordmd5){
		$this->passwordmd5=$passwordmd5;
	}


	/**
	* @param string $idnumber
	* @return void
	*/
	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}


	/**
	* @param string $firstname
	* @return void
	*/
	public function setFirstname($firstname){
		$this->firstname=$firstname;
	}


	/**
	* @param string $lastname
	* @return void
	*/
	public function setLastname($lastname){
		$this->lastname=$lastname;
	}


	/**
	* @param string $email
	* @return void
	*/
	public function setEmail($email){
		$this->email=$email;
	}


	/**
	* @param integer $emailstop
	* @return void
	*/
	public function setEmailstop($emailstop){
		$this->emailstop=$emailstop;
	}


	/**
	* @param string $icq
	* @return void
	*/
	public function setIcq($icq){
		$this->icq=$icq;
	}


	/**
	* @param string $skype
	* @return void
	*/
	public function setSkype($skype){
		$this->skype=$skype;
	}


	/**
	* @param string $yahoo
	* @return void
	*/
	public function setYahoo($yahoo){
		$this->yahoo=$yahoo;
	}


	/**
	* @param string $aim
	* @return void
	*/
	public function setAim($aim){
		$this->aim=$aim;
	}


	/**
	* @param string $msn
	* @return void
	*/
	public function setMsn($msn){
		$this->msn=$msn;
	}


	/**
	* @param string $phone1
	* @return void
	*/
	public function setPhone1($phone1){
		$this->phone1=$phone1;
	}


	/**
	* @param string $phone2
	* @return void
	*/
	public function setPhone2($phone2){
		$this->phone2=$phone2;
	}


	/**
	* @param string $institution
	* @return void
	*/
	public function setInstitution($institution){
		$this->institution=$institution;
	}


	/**
	* @param string $department
	* @return void
	*/
	public function setDepartment($department){
		$this->department=$department;
	}


	/**
	* @param string $address
	* @return void
	*/
	public function setAddress($address){
		$this->address=$address;
	}


	/**
	* @param string $city
	* @return void
	*/
	public function setCity($city){
		$this->city=$city;
	}


	/**
	* @param string $country
	* @return void
	*/
	public function setCountry($country){
		$this->country=$country;
	}


	/**
	* @param string $lang
	* @return void
	*/
	public function setLang($lang){
		$this->lang=$lang;
	}


	/**
	* @param integer $timezone
	* @return void
	*/
	public function setTimezone($timezone){
		$this->timezone=$timezone;
	}


	/**
	* @param string $lastip
	* @return void
	*/
	public function setLastip($lastip){
		$this->lastip=$lastip;
	}


	/**
	* @param string $theme
	* @return void
	*/
	public function setTheme($theme){
		$this->theme=$theme;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param integer $mnethostid
	* @return void
	*/
	public function setMnethostid($mnethostid){
		$this->mnethostid=$mnethostid;
	}

}

?>
