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
	* @var  string
	*/
	public $lastip;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  integer
	*/
	public $role;
	/* constructor */
	 public function userRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->confirmed=0;
		 $this->policyagreed=0;
		 $this->deleted=0;
		 $this->username='';
		 $this->idnumber='';
		 $this->firstname='';
		 $this->lastname='';
		 $this->email='';
		 $this->icq='';
		 $this->skype='';
		 $this->yahoo='';
		 $this->aim='';
		 $this->msn='';
		 $this->phone1='';
		 $this->phone2='';
		 $this->institution='';
		 $this->department='';
		 $this->address='';
		 $this->city='';
		 $this->country='';
		 $this->lang='';
		 $this->timezone=0;
		 $this->lastip='';
		 $this->description='';
		 $this->role=0;
	}
}

?>
