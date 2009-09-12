<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class userDatum {
	/** 
	* @var  string
	*/
	public $action;
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
	public $auth;
	/** 
	* @var  string
	*/
	public $password;
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
	/* constructor */
	 public function userDatum() {
		 $this->action='';
		 $this->confirmed=0;
		 $this->policyagreed=0;
		 $this->deleted=0;
		 $this->username='';
		 $this->auth='';
		 $this->password='';
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
	}
}

?>
