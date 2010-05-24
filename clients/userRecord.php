<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class userRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $auth;
	/** 
	* @var  integer
	*/
	public $confirmed;
	/** 
	* @var  integer
	*/
	public $policyagreed;
	/** 
	* @var  integer
	*/
	public $deleted;
	/** 
	* @var  string
	*/
	public $username;
	/** 
	* @var  string
	*/
	public $idnumber;
	/** 
	* @var  string
	*/
	public $firstname;
	/** 
	* @var  string
	*/
	public $lastname;
	/** 
	* @var  string
	*/
	public $email;
	/** 
	* @var  string
	*/
	public $icq;
	/** 
	* @var  integer
	*/
	public $emailstop;
	/** 
	* @var  string
	*/
	public $skype;
	/** 
	* @var  string
	*/
	public $yahoo;
	/** 
	* @var  string
	*/
	public $aim;
	/** 
	* @var  string
	*/
	public $msn;
	/** 
	* @var  string
	*/
	public $phone1;
	/** 
	* @var  string
	*/
	public $phone2;
	/** 
	* @var  string
	*/
	public $institution;
	/** 
	* @var  string
	*/
	public $department;
	/** 
	* @var  string
	*/
	public $address;
	/** 
	* @var  string
	*/
	public $city;
	/** 
	* @var  string
	*/
	public $country;
	/** 
	* @var  string
	*/
	public $lang;
	/** 
	* @var  integer
	*/
	public $timezone;
	/** 
	* @var  integer
	*/
	public $mnethostid;
	/** 
	* @var  string
	*/
	public $lastip;
	/** 
	* @var  string
	*/
	public $theme;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  integer
	*/
	public $role;
	/** 
	* @var  (profileitemRecords) array of profileitemRecord
	*/
	public $profile;
	/* full constructor */
	 public function userRecord($error='',$id=0,$auth='',$confirmed=0,$policyagreed=0,$deleted=0,$username='',$idnumber='',$firstname='',$lastname='',$email='',$icq='',$emailstop=0,$skype='',$yahoo='',$aim='',$msn='',$phone1='',$phone2='',$institution='',$department='',$address='',$city='',$country='',$lang='',$timezone=0,$mnethostid=0,$lastip='',$theme='',$description='',$role=0,$profile=array()){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->auth=$auth   ;
		 $this->confirmed=$confirmed   ;
		 $this->policyagreed=$policyagreed   ;
		 $this->deleted=$deleted   ;
		 $this->username=$username   ;
		 $this->idnumber=$idnumber   ;
		 $this->firstname=$firstname   ;
		 $this->lastname=$lastname   ;
		 $this->email=$email   ;
		 $this->icq=$icq   ;
		 $this->emailstop=$emailstop   ;
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
		 $this->mnethostid=$mnethostid   ;
		 $this->lastip=$lastip   ;
		 $this->theme=$theme   ;
		 $this->description=$description   ;
		 $this->role=$role   ;
		 $this->profile=$profile   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getAuth(){
		 return $this->auth;
	}

	public function getConfirmed(){
		 return $this->confirmed;
	}

	public function getPolicyagreed(){
		 return $this->policyagreed;
	}

	public function getDeleted(){
		 return $this->deleted;
	}

	public function getUsername(){
		 return $this->username;
	}

	public function getIdnumber(){
		 return $this->idnumber;
	}

	public function getFirstname(){
		 return $this->firstname;
	}

	public function getLastname(){
		 return $this->lastname;
	}

	public function getEmail(){
		 return $this->email;
	}

	public function getIcq(){
		 return $this->icq;
	}

	public function getEmailstop(){
		 return $this->emailstop;
	}

	public function getSkype(){
		 return $this->skype;
	}

	public function getYahoo(){
		 return $this->yahoo;
	}

	public function getAim(){
		 return $this->aim;
	}

	public function getMsn(){
		 return $this->msn;
	}

	public function getPhone1(){
		 return $this->phone1;
	}

	public function getPhone2(){
		 return $this->phone2;
	}

	public function getInstitution(){
		 return $this->institution;
	}

	public function getDepartment(){
		 return $this->department;
	}

	public function getAddress(){
		 return $this->address;
	}

	public function getCity(){
		 return $this->city;
	}

	public function getCountry(){
		 return $this->country;
	}

	public function getLang(){
		 return $this->lang;
	}

	public function getTimezone(){
		 return $this->timezone;
	}

	public function getMnethostid(){
		 return $this->mnethostid;
	}

	public function getLastip(){
		 return $this->lastip;
	}

	public function getTheme(){
		 return $this->theme;
	}

	public function getDescription(){
		 return $this->description;
	}

	public function getRole(){
		 return $this->role;
	}

	public function getProfile(){
		 return $this->profile;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setAuth($auth){
		$this->auth=$auth;
	}

	public function setConfirmed($confirmed){
		$this->confirmed=$confirmed;
	}

	public function setPolicyagreed($policyagreed){
		$this->policyagreed=$policyagreed;
	}

	public function setDeleted($deleted){
		$this->deleted=$deleted;
	}

	public function setUsername($username){
		$this->username=$username;
	}

	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}

	public function setFirstname($firstname){
		$this->firstname=$firstname;
	}

	public function setLastname($lastname){
		$this->lastname=$lastname;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setIcq($icq){
		$this->icq=$icq;
	}

	public function setEmailstop($emailstop){
		$this->emailstop=$emailstop;
	}

	public function setSkype($skype){
		$this->skype=$skype;
	}

	public function setYahoo($yahoo){
		$this->yahoo=$yahoo;
	}

	public function setAim($aim){
		$this->aim=$aim;
	}

	public function setMsn($msn){
		$this->msn=$msn;
	}

	public function setPhone1($phone1){
		$this->phone1=$phone1;
	}

	public function setPhone2($phone2){
		$this->phone2=$phone2;
	}

	public function setInstitution($institution){
		$this->institution=$institution;
	}

	public function setDepartment($department){
		$this->department=$department;
	}

	public function setAddress($address){
		$this->address=$address;
	}

	public function setCity($city){
		$this->city=$city;
	}

	public function setCountry($country){
		$this->country=$country;
	}

	public function setLang($lang){
		$this->lang=$lang;
	}

	public function setTimezone($timezone){
		$this->timezone=$timezone;
	}

	public function setMnethostid($mnethostid){
		$this->mnethostid=$mnethostid;
	}

	public function setLastip($lastip){
		$this->lastip=$lastip;
	}

	public function setTheme($theme){
		$this->theme=$theme;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setRole($role){
		$this->role=$role;
	}

	public function setProfile($profile){
		$this->profile=$profile;
	}

}

?>
